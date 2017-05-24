<?php
/**
 * Created by PhpStorm.
 * User: medved
 * Date: 26.04.17
 * Time: 21:02
 * FrontController
 */


//Включение отображения ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Запуск сесии
session_start();

require_once ('../app/bootstrap.php');