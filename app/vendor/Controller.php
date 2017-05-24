<?php

/**
 * Created by PhpStorm.
 * User: medved
 * Date: 26.04.17
 * Time: 21:06
 */

namespace app\vendor;
use app\vendor\View;

class Controller
{
    public $model;
    public $view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View();
       // $this->model = new Model();
    }

    /**
     * Действие вызиваемое по умолчанию (обычно главная)
     */
    protected function actionIndex()
    {

    }
}