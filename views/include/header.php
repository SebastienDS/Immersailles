<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immersailles</title>
    <link rel="stylesheet" href="css/timeline.css">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="h-full">
    <div class="flex justify-between bg-black px-4" style="height: 10%">
        <div class="flex items-center justify-around w-3/6 md:w-2/6 lg:w-1/6">  
            <a href="<?= SCRIPT_NAME ?>/immersailles.php">             
                <img src="<?= SCRIPT_NAME ?>/public/img/logo.png" alt="logo" width="60" height="60">
            </a>
            <a href="<?= SCRIPT_NAME ?>/immersailles.php">
                <h1 class="italic uppercase text-white text-2xl">Immersailles</h1>
            </a>
        </div>

        <div class="flex justify-around items-center w-3/6 md:w-2/6 lg:w-1/6">
            <h2 class="text-white">A propos</h2>
            <div class="bg-white border-black rounded-full w-12 h-12"></div>
            <a href="<?= SCRIPT_NAME ?>/immersailles.php/connexion">
                <div class="bg-white border-black rounded-full w-12 h-12"></div>
            </a>
        </div>
    </div>