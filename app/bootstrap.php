<?php

use app\vendor\Router;
use app\vendor\Autoloader;

/**
 * Путь к главной папке ...app/
 */
define('ROOT', __DIR__ . '/');

// Автозагрузка классов с namespace
require_once ROOT . 'vendor/Autoloader.php';

//Автозагрузка классов
$autoloader = new Autoloader();

$autoloader->addNamespace('app', __DIR__ . '');
//$autoloader->addNamespace('app', __DIR__ . '');

$autoloader->register();

// Маршрутизатор
require_once ROOT . 'vendor/Router.php';

// Создаем экземпляр класса маршрутизатора
$router = new Router();
$router->run();