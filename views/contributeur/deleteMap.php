<div style="min-height: 80%">

    <?php foreach ($maps as $map): ?>
        <div class="flex justify-between items-center p-6 border">
            
            <div>
                <div>Plan : <?= $map->map ?></div>
                <div>Année : <?= $map->annee ?></div>
                <div>Etage : <?= $map->niveau ?></div>
            </div>

            <div>
                <img src="<?= SCRIPT_NAME ?>/public/img/plans/<?= $map->map ?>.png" alt="preview map" width="300">
            </div>

            <form action="<?= SCRIPT_NAME ?>/immersailles.php/contributeur/map/delete/<?= $map->idNiveau ?>/<?= $map->annee ?>" method="post">
                <button type="submit">
                    <i class="fa fa-trash" style="font-size: 2.5rem"></i>
                </button>
            </form>
        </div>
    <?php endforeach ?>

</div>