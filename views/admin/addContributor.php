<div class="flex justify-center items-center" style="height: 80%">
    <form class="rounded-lg flex justify-around items-center bg-black" style="width: 600px; height: 400px;" action="<?= SCRIPT_NAME ?>/immersailles.php/admin/addContributor" method="POST">
        <div class="flex flex-col justify-around items-center" style="width: 500px; height: 250px;">
            <div class="w-4/6 flex justify-between items-center">
                <label for="username" class="text-white">Pseudo : </label>
                <input class="bg-white h-10 w-48 text-center rounded" type="text" name="username" placeholder="Username" id="username" required>
            </div>

            <div class="w-4/6 flex justify-between items-center">
                <label for="email" class="text-white">E-mail : </label>
                <input class="bg-white h-10 w-48 text-center rounded" type="text" name="email" placeholder="Email" id="email" required>
            </div>

            <div class="w-4/6 flex justify-between items-center">
                <label for="password" class="text-white">Mot de Passe : </label>
                <input class="bg-white h-10 w-48 text-center rounded" type="text" name="password" placeholder="Password" id="password" required>
            </div>

            <div class="flex justify-end w-full pt-6">
                <button type="submit" class="bg-white rounded p-1"> Confirmer</button>
            </div>
        </div>
    </form>
</div>    