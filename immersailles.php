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
$router->post('/', 'App\Controllers\AccueilController@addMarker');
$router->get('/404', 'App\Controllers\NotFoundController@notFound');
$router->get('/en-savoir-plus', 'App\Controllers\AccueilController@enSavoirPlus');


$router->get('/connexion', 'App\Controllers\ConnexionController@connexion');
$router->post('/connexion/validation', 'App\Controllers\ConnexionController@validation');
$router->get('/changePassword', 'App\Controllers\ConnexionController@changePassword');
$router->get('/forgotPassword', 'App\Controllers\ConnexionController@forgotPassword');
$router->get('/logout', 'App\Controllers\ConnexionController@logout');


$router->get('/admin', 'App\Controllers\AdminController@accueil');
$router->get('/admin/contributors', 'App\Controllers\AdminController@contributor');
$router->get('/admin/addContributor', 'App\Controllers\AdminController@addContributorPage');
$router->post('/admin/addContributor', 'App\Controllers\AdminController@addContributor');
$router->post('/admin/deleteContributor/:idProfil', 'App\Controllers\AdminController@deleteContributor');


$router->get('/contributeur', 'App\Controllers\ContributeurController@accueil');
$router->get('/contributeur/mapManagement', 'App\Controllers\ContributeurController@mapManagement');
$router->get('/contributeur/map/infos/:mapName', 'App\Controllers\ContributeurController@mapInfos');
$router->post('/contributeur/map/infos/:mapName', 'App\Controllers\ContributeurController@addMap');



$router->get('/infos/:id', 'App\Controllers\APIController@getInfos');


$router->run();