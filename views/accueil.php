<div style="height: 80%">
	<div class="flex justify-between">
		<div class="flex justify-around mx-12 my-2 w-2/3">
			<div>Trier par <span class="text-blue-800"> Objects (330) </span></div>
			<div >Tout (330)</div>
			<div>OEuvres d'art (120)</div>
			<div>Mobilier (100)</div>
			<div>Décoration (110)</div>
		</div>

		<?php if (isset($_SESSION['auth'])): ?>
			<div class="flex items-center justify-around w-2/12 px-6 cursor-pointer" id="addMarker">
				Ajouter un marker <i class="fa fa-plus px-2" style="font-size:45px"></i>
			</div>
			<div class="flex items-center justify-around w-1/5 px-6 cursor-pointer" id="deleteMarker">
				Supprimer un marker <i class="fa fa-minus px-2" style="font-size:45px"></i>
			</div>
		<?php endif ?>
	</div>

	<div class="flex flex-col md:flex-row" style='height: 73%;'>
		<div class="bg-gray-500 md:w-3/4 h-full" id="map"></div>

		<div class="bg-black md:w-1/4 flex justify-items-center">
			<div class="text-white flex flex-col justify-around py-24 text-2xl font-bold text-center" id='tuto'>
				<div>
					Cliquez sur un <i class="fa fa-map-marker" style="font-size:45px"></i>
				</div>
				<div>
					Cela affichera les informations du marqueur.
				</div>
			</div>

			<div class="text-white hidden text-2xl font-bold text-center" id='tutoDelete'>
				<div class="relative">
					<span class="absolute top-0 right-0 p-2" id="close">
						<svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
							<title>Close</title>
							<path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
						</svg>
					</span>
				</div>
				<div class="flex items-center h-full">
					<div>
						Cliquez sur un <i class="fa fa-map-marker" style="font-size:45px"></i> pour le supprimer
					</div>
				</div>
			</div>

			<form id='markerForm' class="hidden items-center" method="post">
				<div class="relative">
					<span class="absolute top-0 right-0 p-2" id="close">
						<svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
							<title>Close</title>
							<path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
						</svg>
					</span>
				</div>
				<div class="flex items-center h-full">
					<div class="text-white flex flex-col justify-around items-center w-full" style="height: 80%">
						<input type="text" maxlength="10" placeholder="ID wikidata" class="w-2/6 px-4 py-2 rounded text-black" name="IDWikiData" required>
						<div class="flex justify-around">
							<input type="number" step="any" id="x" placeholder="X" class="w-2/6 px-4 py-2 rounded text-black" name="X" required>
							<input type="number" step="any" id="y" placeholder="Y" class="w-2/6 px-4 py-2 rounded text-black" name="Y" required>
						</div>
						<input type="hidden" name="idNiveau" value="<?= $map->idNiveau ?>">
						<input type="hidden" name="etage" value="<?= $_GET['etage'] ?>">
						<input type="hidden" name="currentDate" value="<?= $_GET['currentDate'] ?>">

						<button type="submit" class="w-2/6 px-4 py-2 rounded border">Envoyer</button>
					</div>
				</div>
			</form>

			<div id="infos" class="hidden">
				<div class="bg-white h-48 relative border overflow-hidden">
					<img src="#" class="w-full block -my-20" id="image">
					<span class="absolute top-0 right-0 p-2" id="close">
						<svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
							<title>Close</title>
							<path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
						</svg>
					</span>

					<h1 class="absolute uppercase font-extrabold bottom-0 right-0 mr-4 px-3 py-0 bg-white rounded-lg" id='name'></h1>
				</div>

				<div>
					<div class="p-4 text-white">

						<div>
							<h3 class="inline text-orange-400">Type d'objet :</h3>
							<p class="inline text-xs">Personnage</p>
						</div>

						<div class="mt-2">
							<h3 class="inline text-orange-400">Date de naissance :</h3>
							<p class="inline text-xs" id='birth'></p>
						</div>

						<div class="mt-2">
							<h3 class="inline text-orange-400">Date de mort :</h3>
							<p class="inline text-xs" id='death'></p>
						</div>

						<div class="mt-2">
							<h3 class="text-orange-400">Description :</h3>
							<p class="text-xs" id="description"></p>
						</div>

						<div class="mt-2">
							<h3 class="text-orange-400">Liens utiles :</h3>
							<p class="text-xs"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bg-white flex justify-around">
		<ul class="timeline" id="timeline">
			<?php foreach ($dates as $date) : ?>
				<li class="li <?= $date->annee <= $currentDate ? 'complete' : '' ?>">
					<div class="timestamp">
						<span class="date"><?= $date->annee ?></span>
					</div>
					
					<a href="<?= SCRIPT_NAME ?>/immersailles.php?currentDate=<?= $date->annee ?>" class="status"></a>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
</div>

<script>
	const close = document.querySelectorAll('#close');
	const addMarker = document.querySelector('#addMarker');
	const markerForm = document.querySelector('#markerForm');
	const deleteMarker = document.querySelector('#deleteMarker');
	const X = document.querySelector('#x');
	const Y = document.querySelector('#y');
	const image_ = document.querySelector('#image');
	const tutoDelete = document.querySelector('#tutoDelete');
	const tuto = document.querySelector('#tuto');
	const infos = document.querySelector('#infos');
	const name = document.querySelector('#name');
	const description = document.querySelector('#description');
	const birth = document.querySelector('#birth');
	const death = document.querySelector('#death');
	

	const img = document.createElement('img');
	img.src = 'public/img/plans/<?= $map->map ?>.png';

	const createEtage = function (numEtage, currentEtage=false, disabled=false) {
		const etage = document.createElement('a');
		etage.classList.add("leaflet-control-zoom-in");
		etage.innerText = numEtage;

		if (currentEtage) {
			etage.style.backgroundColor = '#f6ad55';
			etage.style.color = 'gray';
		}

			etage.classList.add("leaflet-disabled");
		if (disabled || currentEtage) { 
			return etage;
		}
		etage.href += '?etage=' + numEtage + "&currentDate=<?= $currentDate ?>";

		return etage;
	}

	const icon = L.icon({
		iconSize: [38, 50], 
		iconUrl: 'public/img/marker.png',
    	iconAnchor: [20, 50]
	});
			
	img.addEventListener('load', () => {
		const bounds = [
			[0, 0],
			[img.height / 6, img.width / 6]
		];

		const center = [bounds[1][0] / 2, bounds[1][1] / 2];
		
		const map = L.map('map', {
			crs: L.CRS.Simple,
			center: center,
			minzoom: 0
		});
		map.fitBounds(bounds);
		
		const image = L.imageOverlay(img, bounds).addTo(map);

		const marker = L.marker([-10000, -10000]).addTo(map);
		marker.setOpacity(0);

		const setCoord = function (e) {
			const {lat, lng} = e.latlng;
			X.value = lat;
			Y.value = lng;
			marker.setLatLng(e.latlng);
			marker.setOpacity(1);

			X.addEventListener('change', (e) => {
				const {lat, lng} = marker.getLatLng();
				marker.setLatLng([e.target.value, lng]);
			});

			Y.addEventListener('change', (e) => {
				const {lat, lng} = marker.getLatLng();
				marker.setLatLng([lat, e.target.value]);
			});
		};

		const hideMarker = function () {
			map.removeEventListener('click', setCoord);
			X.value = '';
			Y.value = '';
			marker.setOpacity(0);
			marker.setLatLng([-10000, -10000]);
		} 

		const fetchData = function (idWikiData) {
			fetch(`immersailles.php/infos/${idWikiData}`, {
				credentials: 'same-origin', 
				mode: 'cors'
			})
			.then(data => data.json())
			.then(json => {
				image_.src = json.image;
				name.innerText = json.name;
				description.innerText = json.description;
				birth.innerText = json.birth;
				death.innerText = json.death;

				tuto.style.display = 'none';
				markerForm.style.display = 'none';
				tutoDelete.style.display = 'none';
				infos.style.display = 'block';

				hideMarker();
			})
			.catch(err => console.error(err));
		}

		const marks = <?= json_encode($markers) ?>;
		const markers = [];
		
		marks.forEach(marker => {
			const m = L.marker([marker.X, marker.Y], {icon: icon})
				.addTo(map)
				.addEventListener('click', () => fetchData(marker.idWikiData));
			m.X = marker.X;
			m.Y = marker.Y;
			m.idWikiData = marker.idWikiData;

			markers.push(m);
		});
			
		const deleteMarkerEvent = function (event) {
			const marker = event.target;
			fetch(`immersailles.php/contributeur/deleteMarker/<?= $map->idNiveau ?>/${marker.idWikiData}/${marker.X}/${marker.Y}`, {
				method: 'POST',
				credentials: 'same-origin', 
				mode: 'cors'
			});
			location.reload();
		}

		const addDeleteEvent = function () {
			markers.forEach(marker => {
				marker.addEventListener('click', deleteMarkerEvent);
			});
		}
		
		const removeDeleteEvent = function () {
			markers.forEach(marker => {
				marker.removeEventListener('click', deleteMarkerEvent);
			});
		}

		close.forEach(btn => {
			btn.addEventListener('click', () => {
				infos.style.display = 'none';
				markerForm.style.display = 'none';
				tutoDelete.style.display = 'none';
				tuto.style.display = 'flex';

				hideMarker();
				removeDeleteEvent();
			});
		});

		if (addMarker) {
			addMarker.addEventListener('click', () => {
				removeDeleteEvent();

				tuto.style.display = 'none';
				infos.style.display = 'none';
				tutoDelete.style.display = 'none';
				markerForm.style.display = 'block';

				map.addEventListener('click', setCoord); 
			});
		}

		if (deleteMarker) {
			deleteMarker.addEventListener('click', () => {
				tuto.style.display = 'none';
				infos.style.display = 'none';
				markerForm.style.display = 'none';
				tutoDelete.style.display = 'block';

				addDeleteEvent();
			})
		}


		const etagePosition = document.querySelector('.leaflet-bottom.leaflet-left');

		const container = document.createElement('div');
		container.classList.add('leaflet-control-zoom', 'leaflet-bar', 'leaflet-control');

		<?php foreach (array_reverse($etages) as $etage): ?>
			container.appendChild(createEtage(<?= $etage->etage ?>, <?= json_encode($currentEtage == $etage->etage ? true : false) ?>, <?= (!$etage->nombre) || ($currentEtage == $etage->etage) ?>));
		<?php endforeach ?>

		etagePosition.appendChild(container);
	});
</script>