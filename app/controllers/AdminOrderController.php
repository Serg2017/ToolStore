<?php
/**
 * Контроллер AdminOrderController
 */
namespace app\controllers;
use app\components\AdminBase;
use app\models\Order;

class AdminOrderController extends AdminBase
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
     * Action страницы заказов
     * @return mixed
     */
    public function actionIndex()
    {

        $orders = Order::getOrders();

        $data = [
            'title' => 'Главная страница Суперпользователя',
            'orders' => $orders,
        ];

        return $this->view->view('template/admin_template', 'admin_order/index', $data);
    }

    public function actionDelete($id)
    {
        $result = Order::deleteOrder($id);
        if($result) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        return false;
    }
}