<?php
require_once 'vendor/autoload.php';

use App\Router;
use App\Controller\UserController;
use App\Controller\SongUploadController;
use App\Controller\SessionController;
use App\View\Render;

$router = new Router();

$router->get('/', Render::class . '::render_homepage');
$router->post('/', Render::class .'::render_homepage');

$router->get('/playlist', Render::class . '::render_playlist');

$router->get('/register', Render::class . '::render_register');
$router->post('/register', UserController::class . '::register');


$router->get('/login', Render::class . '::render_login');
$router->post('/login', UserController::class . '::login');
$router->get('/logout', SessionController::class. '::logOut');


$router->get('/verify', UserController::class . '::enable');


$router->get('/upload', Render::class . '::render_upload');
$router->post('/upload', SongUploadController::class . '::upload');

$router->addNotFoundHandler(function () {
    echo "404 ERROR <br> Page not found <br> Go to <a href=/>Homepage</a>";
});

$router->run();
