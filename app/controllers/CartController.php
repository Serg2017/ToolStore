<?php
/**
 * Created by PhpStorm.
 * User: medved
 * Date: 18.05.17
 * Time: 15:14
 */

namespace app\controllers;
use app\models\Cart;
use app\models\Category;
use app\models\Product;
use app\vendor\Controller;

class CartController extends Controller
{
    /**
     * Action главной страницы корзины
     * @return int|mixed
     */
    public function actionIndex()
    {
        //Категории меню
        $categories = Category::getCategories();

        //Если корзина пуста выполняем пераправление
        if(Cart::getTotalProductInCart() == 0) {
           header('Location: '. $_SERVER['HTTP_REFERER']);
           return 0;
        }

        //Получаем товары с корзины
        $productsInCart = Cart::getProductsInCart();
        //Идентификаторы товаров
        $productsIds = array_keys($productsInCart);

        //Получаем товары по идентификаторам
        $productsByIds = Product::getProductsByIds($productsIds);

        //Общие количество товаров в корзине
        $totalProductInCart = Cart::getTotalProductInCart();

        $data = [
            'title'              => 'Корзина товаров',
            'meta_d'             => 'Корзина товаров',
            'meta_k'             => 'Корзина товаров',
            'categories'         => $categories,
            'totalProductInCart' => $totalProductInCart,
            'productsInCart'     => $productsInCart,
            'productsByIds'      => $productsByIds,
            'totalPrice'         => 0,
        ];

        return $this->view->view('template/main_template', 'cart/index', $data);
    }

    /**
     * Action добавлене в корзину
     * @param $idProduct <p>Идентификатор товара</p>
     * @return int
     */
    public function actionAdd($idProduct) {

        Cart::addProductInCart($idProduct);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return 0;
    }
}