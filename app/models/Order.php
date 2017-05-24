<?php
/**
 * Модель обработки заказов
 */

namespace app\models;
use app\vendor\Model;

class Order extends Model
{
    /**
     * @var string <p>Таблица в БД</p>
     */
    private static $table = 'orders';

    /**
     * Оформление нового заказа
     * @param $orderData <p>Данные заказа</p>
     * @param null $userId <p>Идентификатор пользователя (если он зщарегистрирован)</p>
     * @return \PDOStatement
     */
    public static function toOrder($orderData, $userId = null)
    {
        $name     = htmlspecialchars($orderData['name']);
        $phone    = htmlspecialchars($orderData['phone']);
        $email    = htmlspecialchars($orderData['email']);
        $comment  = htmlspecialchars($orderData['comment']);
        $products = $orderData['products'];
        $userId   = (int)$userId;

        return self::run('INSERT INTO  '. self::$table . ' '
                            .'(name, phone, email, products, comment, user_id) '
                            .'VALUE (:name, :phone, :email, :products, :comment, :user_id)',
                            [
                                'name' => $name, 'phone'=> $phone,
                                'email' => $email, 'products' => $products,
                                'comment' => $comment, 'user_id' => $userId
                            ]
        );
    }

    /**
     * Все заказы определенного пользователя
     * @param $idUser <p>Идентификатор пользователя</p>
     * @return array <p>Заказы</p>
     */
    public static function getOrdersById($idUser)
    {
        $idUser = (int)$idUser;
        return self::run('SELECT * FROM ' . self::$table . ' '
                            .'WHERE user_id = :id',
                            [
                                'id' => $idUser
                            ]
        )->fetchAll();
    }

    /**
     * Получаем все заказы (админка)
     * @return array
     */
    public static function getOrders()
    {
        return self::run('SELECT * FROM ' . self::$table)->fetchAll();
    }


    public static function deleteOrder($id)
    {
        $id = (int)$id;
        return self::run('DELETE FROM ' . self::$table . ' WHERE id = :id',
            ['id' => $id]);
    }

}