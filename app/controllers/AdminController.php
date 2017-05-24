<?php
/**
 * Контроллер AdminController
 */

namespace app\controllers;
use app\components\AdminBase;

class AdminController extends AdminBase
{

    /**
     * AdminUserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        self::checkAdmin();
    }

    /**
     * Action главной страницы админки
     * @return mixed
     */
    public function actionIndex()
    {

        $data = [
            'title' => 'Главная страница Суперпользователя'
        ];

        return $this->view->view('template/admin_template', 'admin/index', $data);
    }



}