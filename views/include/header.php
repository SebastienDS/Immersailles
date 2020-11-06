<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immersailles</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

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