<?php
/**
 * Created by PhpStorm.
 * User: medved
 * Date: 19.05.17
 * Time: 13:27
 */

namespace app\controllers;
use app\models\Order;
use app\models\Product;
use app\models\User;
use app\vendor\Controller;

class CabinetController extends Controller
{
    /**
     * Action главной страницы кабинета
     * @return mixed
     */
    public function actionIndex()
    {
        //Получаем идентификатр пользователя
        $userId = User::checkLogged();

        //Имя пользователя
        $userName = User::getUserInfo($userId)['name'];

        $data = [
            'title'    => 'Кабинет пользователя',
            'userName' => $userName,
        ];

        return $this->view->view('template/cabinet_template', 'cabinet/index', $data);
    }

    /**
     * Action истории покупок
     * @return mixed
     */
    public function actionHistory()
    {

        //Получаем идентификатр пользователя
        $userId = User::checkLogged();

        //Имя пользователя
        $userName = User::getUserInfo($userId)['name'];

        //Покупки
        $ordersById = Order::getOrdersById($userId);

        $data = [
            'title'      => 'История покупок',
            'userName'   => $userName,
            'ordersById' => $ordersById,
        ];

        return $this->view->view('template/cabinet_template', 'cabinet/history', $data);
    }


}