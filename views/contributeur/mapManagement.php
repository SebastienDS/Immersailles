<div style="min-height: 80%">

    <?php foreach ($maps as $map): ?>
        <div class="flex justify-between items-center p-6 border">
            
            <div><?= $map ?></div>

            <div>
                <img src="<?= SCRIPT_NAME ?>/depot/maps/<?= $map ?>" alt="preview map" width="300">
            </div>

            <a href="<?= SCRIPT_NAME ?>/immersailles.php/contributeur/map/infos/<?= $map ?>"><i class="fa fa-plus" style="font-size: 2.5rem"></i></a>
        </div>
    <?php endforeach ?>

</div>