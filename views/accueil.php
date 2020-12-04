<div style="height: 80%">
	<div class="flex justify-around mx-12 my-2 w-2/3">
		<div>Trier par <span class="text-blue-800"> Objects (330) </span></div>
		<div >Tout (330)</div>
		<div>OEuvres d'art (120)</div>
		<div>Mobilier (100)</div>
		<div>Décoration (110)</div>
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

			<div id="infos" class="hidden">
				<div class="bg-white h-48 relative border overflow-hidden">
					<img src="#"class="w-full block -my-20" id="image">
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
							<p class="inline text-xs">Oeuvre d'art - Fauteuil</p>
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
	const close = document.querySelector('#close');
	const image_ = document.querySelector('#image');
	const tuto = document.querySelector('#tuto');
	const infos = document.querySelector('#infos');
	const name = document.querySelector('#name');
	const description = document.querySelector('#description');
	const birth = document.querySelector('#birth');
	const death = document.querySelector('#death');

	const img = document.createElement('img');
	img.src = 'public/img/plan1.png';

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


		const marker = L.marker(center).addTo(map);
		marker.bindPopup('I am a popup.').openPopup();


		marker.addEventListener('click', () => {
			fetch('immersailles.php/infos/Q7742')
			.then(data => data.json())
			.then(json => {
				image_.src = json.image;
				name.innerText = json.name;
				description.innerText = json.description;
				birth.innerText = json.birth;
				death.innerText = json.death;

				infos.style.display = 'block';
				tuto.style.display = 'none';
				console.log(json);
			});
		})

		close.addEventListener('click', () => {
			infos.style.display = 'none';
			tuto.style.display = 'flex';
		});

		// const popup = L.popup();
		// map.on('click', e => {
		// 	popup.setLatLng(e.latlng)
		// 		.setContent('You clicked the map at ' + e.latlng)
		// 		.openOn(map);
		// });




		const createEtage = function (numEtage, disabled=false) {
			const etage = document.createElement('a');
			etage.classList.add("leaflet-control-zoom-in");
			etage.innerText = numEtage;

			if (disabled) { 
				etage.classList.add("leaflet-disabled");
				return etage;
			}
			etage.href += '?etage=' + numEtage + "&currentDate=<?= $currentDate ?>";

			return etage;
		}

		const etagePosition = document.querySelector('.leaflet-bottom.leaflet-left');

		const container = document.createElement('div');
		container.classList.add('leaflet-control-zoom', 'leaflet-bar', 'leaflet-control');

		<?php for ($i=3; $i >= 0; $i--): ?>
			container.appendChild(createEtage(<?= $i ?>, <?= json_encode($currentEtage == $i ? true : false) ?>));
		<?php endfor ?>

		etagePosition.appendChild(container);
	});
</script>