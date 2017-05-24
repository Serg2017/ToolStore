<?php
/**
 * Контроллер OrderController
 */

namespace app\controllers;
use app\models\Cart;
use app\models\Category;
use app\models\Order;
use app\models\User;
use app\vendor\Controller;

class OrderController extends Controller
{
    /**
     * Action для страницы оформление заказа
     * @return mixed
     */
    public function actionIndex()
    {
        //Категории меню
        $categories = Category::getCategories();

        $orderData['name']    = '';
        $orderData['phone']   = '';
        $orderData['email']   = '';
        $orderData['comment'] = '';

        $errors = false;
        $result = false;
        $userId = null;

        //Проверка на авторизацию пользователя
        if($userId = User::isGuest()) {
            $orderData['name'] = User::getUserInfo($userId)['name'];
            $orderData['email'] = User::getUserInfo($userId)['email'];
        }

        if(isset($_POST['submit'])) {
            $orderData['name']    = $_POST['name'];
            $orderData['phone']   = $_POST['phone'];
            $orderData['email']   = $_POST['email'];
            $orderData['comment'] = $_POST['comment'];

            //Получаем товары с корзины
            $productsInCart = Cart::getProductsInCart();
            $orderData['products'] = json_encode($productsInCart);

            if(!User::checkName($orderData['name'])) {
                $errors[] = 'Имя должно состять минимум из 3 символов и не содержать цыфр';
            }

            if(!User::checkPhone($orderData['phone'])) {
                $errors[] = 'Некорректный номер телефона';
            }

            if($errors == false) {
                if($result = Order::toOrder($orderData, $userId)) {
                    Cart::clearCart();
                    header('Location: /');
                } else {
                    $errors[] = 'Ошибка оформления заказа';
                }
            }


        }

        $data = [
            'title'      => 'Оформление заказа',
            'meta_d'     => 'Оформление заказа',
            'meta_k'     => 'Оформление заказа',
            'categories' => $categories,
            'orderData'  => $orderData,
            'errors'     => $errors,
            'result'     => $result,
        ];

        return $this->view->view('template/main_template', 'order/index', $data);
    }
}