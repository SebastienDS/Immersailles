<div style="height: 80%">
	<div class="flex h-24 md:h-20 bg-white flex-col md:flex-row justify-around md:justify-start">
		<div class="flex flex-col justify-around md:w-2/6">
			<div class="mx-12">
				Trier par <span class="text-blue-800"> Objects (330) </span>
			</div>
			<div class="flex justify-around text-xs">
				<div>Tout (330)</div>
				<div>OEuvres d'art (120)</div>
				<div>Mobilier (100)</div>
				<div>Décoration (110)</div>
			</div>

		</div>
		<div class="md:w-2/6 flex justify-center items-center">
			<h1 class="text-2xl">
				Aile Ouest du château -RDC
			</h1>
		</div>

	</div>

	<div class="flex flex-col md:flex-row" style='height: 68.4%;'>
		<div class="bg-gray-500 md:w-3/4 h-full" id="map"></div>

		<div class="bg-black md:w-1/4">

			<div class="bg-white h-32 relative border overflow-hidden">
				<img src="<?= $image ?>" alt="" class="w-full block -my-20">
				<span class="absolute top-0 right-0 p-2">
					<svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
						<title>Close</title>
						<path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
					</svg>
				</span>

				<h1 class="absolute uppercase font-extrabold bottom-0 right-0 mr-4 py-0 bg-white rounded-lg">
					Nom de l'objet
				</h1>
			</div>

			<div>
				<div class="p-4 text-white">

					<div>
						<h3 class="inline text-orange-400">Type d'objet :</h3>
						<p class="inline text-xs">Oeuvre d'art - Fauteuil</p>
					</div>

					<div>
						<h3 class="inline text-orange-400">Date d'arrivée et de départ :</h3>
						<p class="inline text-xs">1682</p>
					</div>

					<div>
						<h3 class="inline text-orange-400">Localisation :</h3>
						<p class="inline text-xs">appartement de Louis XIV</p>
					</div>

					<div class="mt-2">
						<h3 class="text-orange-400">Description :</h3>
						<p class="text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio ipsa ea quis earum hic temporibus nulla consequatur, reprehenderit, illum quaerat cupiditate laboriosam quos repellat delectus sit. Eaque sequi facere quaerat.</p>
					</div>

					<div class="mt-2">
						<h3 class="text-orange-400">Liens utiles :</h3>
						<p class="text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt ducimus, aliquid odio cumque quae odit labore laudantium</p>
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
	const img = document.createElement('img');
	img.src = 'public/img/plan1.png';

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

	// const popup = L.popup();
	// map.on('click', e => {
	// 	popup.setLatLng(e.latlng)
	// 		.setContent('You clicked the map at ' + e.latlng)
	// 		.openOn(map);
	// })
</script>

<script>
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
</script>