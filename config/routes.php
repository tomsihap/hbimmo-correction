<?php

use Bramus\Router\Router;

$router = new Router();
$router->setNamespace('App\Controller');

$router->get('/', 'AppController@index');
$router->get('/asset', 'AssetsController@index');
$router->get('/asset/create', 'AssetsController@create');
$router->post('/asset', 'AssetsController@new');
$router->get('/asset/(\d+)', 'AssetsController@show');
$router->post('/contact', 'ContactsController@new');

$router->run();
