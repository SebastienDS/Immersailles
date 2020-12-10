<div style="height: 80%">
    <div class="flex justify-center items-center p-6">
        <div class="bg-gray-500 px-6 py-3 rounded-xl">
            <a href="<?= SCRIPT_NAME ?>/immersailles.php/admin/addContributor" class="btn">Ajouter un contributeur</a>
        </div>
    </div>

    <?php foreach ($contributors as $contributor): ?>
        <a href="<?= SCRIPT_NAME ?>/immersailles.php/admin/updateContributor/<?= $contributor->idProfil ?>">
            <div class="flex justify-between items-center p-6 border">
                <div class="w-1/4 flex justify-between">
                    <div>
                        <?= $contributor->username ?> 
                    </div>
                    <div>
                        <?= $contributor->email ?>
                    </div>
                </div>

                <form method="post" action="<?= SCRIPT_NAME ?>/immersailles.php/admin/deleteContributor/<?= $contributor->idProfil ?>">
                    <button type="submit"><i class="fa fa-trash" style="font-size: 40px"></i></button>
                    <input type="hidden" name="idProfil" value="<?= $contributor->idProfil ?>">
                </form>
            </div>
        </a>
    <?php endforeach ?>

</div>