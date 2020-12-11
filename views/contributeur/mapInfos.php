<div style="height: 80%" class="flex justify-center items-center">
    <form class="w-full flex flex-col justify-between" style="height: 30%" method="post">
        <div class="flex justify-center">
            <div class="flex justify-around" style="width: 50%">
                <div>
                    <label for="annee">Année :</label>
                    <input type="number" name="annee" placeholder="Année" id="annee" class="border border-black rounded text-center" required>
                </div>

                <div>
                    <label for="etage">Etage :</label>
                    <select name="etage" id="etage">
                        <?php foreach ($etages as $etage): ?>
                            <option value="<?= $etage->idEtage ?>"> <?= $etage->idEtage ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex justify-end px-56 py-6">
            <button type="submit" class="bg-black text-white rounded px-6 py-2">
                Confirmer                
            </button>
        </div>
</form>
</div>