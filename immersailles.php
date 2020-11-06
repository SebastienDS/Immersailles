<?php

use Router\Router;

require_once 'vendor/autoload.php';

require_once 'database/dbParams.php';
define('SCRIPT_NAME', str_replace('/immersailles.php', '', $_SERVER['SCRIPT_NAME']));

$fullUrl = $_SERVER['PHP_SELF'];
$prefix = $_SERVER['SCRIPT_NAME'];

$url = substr($fullUrl, strlen($prefix));


$router = new Router($url);

$router->get('/', 'App\Controllers\AccueilController@index');
$router->get('/en-savoir-plus', 'App\Controllers\AccueilController@enSavoirPlus');

$router->get('/admin', 'App\Controllers\AdminController@accueil');
$router->get('/contributeur', 'App\Controllers\ContributeurController@accueil');


$router->get('/connexion', 'App\Controllers\ConnexionController@connexion');
$router->post('/connexion/validation', 'App\Controllers\ConnexionController@validation');
$router->get('/changePassword', 'App\Controllers\ConnexionController@changePassword');
$router->get('/forgotPassword', 'App\Controllers\ConnexionController@forgotPassword');
$router->get('/logout', 'App\Controllers\ConnexionController@logout');

$router->get('/404', 'App\Controllers\NotFoundController@notFound');


$router->run();