<?php
/**
 * Модель для работы с Корзиной товаров
 */

namespace app\models;


use app\vendor\Model;

class Cart extends Model
{
    /**
     * Добавление товара в корзину
     * @param $idProduct <p>идентификатор товара</p>
     * @return array <p>товары в корзине</p>
     */
    public static function addProductInCart($idProduct)
    {
        $idProduct = (int)$idProduct;

        $productInCart = [];

        if (isset($_SESSION['products'])) {
            $productInCart = $_SESSION['products'];
        }

        if (array_key_exists($idProduct, $productInCart)) {
            $productInCart[$idProduct]++;
        } else {
            $productInCart[$idProduct] = 1;
        }

        $_SESSION['products'] = $productInCart;

        return $productInCart;
    }

    /**
     * Количество товаров в корзине
     * @return int <p>количество товаров</p>
     */
    public static function getTotalProductInCart()
    {
        $total = 0;
        if (isset($_SESSION['products'])) {
            $total = 0;
            foreach ($_SESSION['products'] as $id => $count) {
                $total += $count;
            }
        }
        return $total;
    }

    /**
     * Товыры в корзине
     * @return bool|array <p>массив с товарами или false</p>
     */
    public static function getProductsInCart()
    {
        if(isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    /**
     * Очистка корзины
     * @return bool <p>true|false</p>
     */
    public static function clearCart()
    {
        if(isset($_SESSION['products'])) {
            unset($_SESSION['products']);
            return true;
        }
        return false;
    }

}