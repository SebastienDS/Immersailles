<div class="flex justify-center items-center" style="height: 80%">
    <form class="w-56 h-56 bg-black rounded-lg flex justify-around items-center" style="width: 500px; height: 350px;" action="<?= SCRIPT_NAME ?>/immersailles.php/connexion/validation" method="POST">
        <div class="flex flex-col justify-around items-center" style="width: 500px; height: 250px;">
            <?php if ($msg_error): ?>
                <h2 class="text-red-600"><?= $msg_error ?></h2>
            <?php endif ?>
            <input class="bg-white h-10 w-48 text-center rounded" type="text" name="username" placeholder="Username" >
            <div class="flex flex-col">
                <input class="bg-white h-10 w-48 text-center rounded" type="password" name="password" placeholder="Password">
                <a class="text-gray-600 text-xs hover:underline" href="<?= SCRIPT_NAME ?>/immersailles.php/forgotPassword">Mot de Passe oublié</a>
            </div>
            <div class="flex justify-end w-3/4">
                <button type="submit" class="bg-white rounded p-1"> Se connecter</button>
            </div>
        </div>
    </form>
</div>    