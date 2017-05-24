<?php
/**
 * Модель работы с товарами
 */

namespace app\models;
use app\vendor\Model;

class Product extends Model
{
    /**
     * @var string <p>таблица для выборки</p>
     */
    private static $table = 'products';

    /**
     * @var string <p>Количество товаров для выборки</p>
     */
    private static $quantity = 9;

    /**
     * Выбор последних добавленных товаров (новинки)
     * @return array <p>товары</p>
     */
    public static function getLastProducts()
    {
        $result =  self::run('SELECT id, img, name, brand, price '
                             .'FROM ' . self::$table . ' '
                             .'WHERE status = 1 '
                             .'ORDER BY id DESC '
                             .'LIMIT ' . self::$quantity
        );

        return $result->fetchAll();
    }


    /**
     * Товары по категориям
     * @param $idCat <p>Идентификатор категории</p>
     * @return array <p>Массив товаров</p>
     */
    public static function getProductsByCategory($idCat) {
        $idCat = (int)$idCat;
        return self::run('SELECT id, img, name, brand, price '
                            .'FROM ' . self::$table . ' '
                            .'WHERE status = 1 AND category_id = :id '
                            .'ORDER BY id DESC '
                            .'LIMIT ' . self::$quantity
            , ['id' => $idCat])->fetchAll();
    }

    /**
     * Подробные просмотр товара
     * @param $idProduct <p>Идентификатор товара</p>
     * @return mixed <p>информация о товаре</p>
     */
    public static function getProductById($idProduct) {

        $idProduct = (int)$idProduct;

        return self::run('SELECT id, title, meta_d, meta_k, img, name, brand, price, description, availability '
                            .'FROM ' . self::$table . ' '
                            .'WHERE id = :id'
                            ,['id' => $idProduct])->fetch();
    }


    /**
     * Товары по идентификаторам
     * @param array $ids <p>Идентификаторы товаров</p>
     * @return array
     */
    public static function getProductsByIds($ids = [])
    {
        $ids = array_map('intval', $ids);
        $ids = implode(',', $ids);

        return self::run('SELECT id, name, price '
                            .'FROM ' . self::$table. ' '
                            .'WHERE id IN (' . $ids . ') '
        )->fetchAll();
    }

    /**
     * Определим статус товара
     * @param $availability <p>стутус в виде цифры</p>
     * @return false|string <p>Доступность</p>
     */
    public static function getAvailability($availability) {
        $availability = (int)$availability;
        $result = false;
        switch ($availability) {
            case 1:
                $result = 'В наличии';
                break;
            case 2:
                $result = 'На скаладе';
                break;
            case 3:
                $result = 'Нет в наличии';
                break;
            default: $result = 'Уточните';
        }
        return $result;
    }


    /**
     * Получаем все товары (админка)
     * @return array <p>товары</p>
     */
    public static function getProducts()
    {
        return self::run('SELECT * FROM ' . self::$table)->fetchAll();
    }

    public static function getProductByIdAdmin($id) {
        $id = (int)$id;
        return self::run('SELECT * FROM ' . self::$table . ' WHERE id = :id', ['id'=>$id])->fetch();
    }


    /**
     * Добавление нового товара (админка)
     * @param $product <pТовары</p>
     * @return \PDOStatement
     */
    public static function add($product)
    {

        $product['title']        = htmlspecialchars($product['title']);
        $product['meta_d']       = htmlspecialchars($product['meta_d']);
        $product['meta_k']       = htmlspecialchars($product['meta_k']);
        $product['img']          = htmlspecialchars($product['img']);
        $product['name']         = htmlspecialchars($product['name']);
        $product['brand']        = htmlspecialchars($product['brand']);
        $product['availability'] = (int)$product['availability'];
        $product['price']        = (int)$product['price'];
        $product['description']  = htmlspecialchars($product['description']);
        $product['priority']     = (int)$product['priority'];
        $product['status']       = (int)$product['status'];
        $product['category_id']  = (int)$product['category_id'];

        return self::run('INSERT INTO ' . self::$table . ' '
                            .'(title, meta_d, meta_k, img, name, brand, availability, 
                            price, description, priority, status, category_id) '
                            .'VALUE(:title, :meta_d, :meta_k, :img, :name, :brand, :availability, 
                            :price, :description, :priority, :status, :category_id)',
                            [
                                'title' => $product['title'], 'meta_d' => $product['meta_d'],
                                'meta_k' => $product['meta_k'], 'img' => $product['img'],
                                'name' => $product['name'], 'brand' => $product['brand'],
                                'availability' => $product['availability'], 'price' =>(int)$product['price'],
                                'description' => $product['description'], 'priority' => (int)$product['priority'],
                                'status' => (int)$product['status'], 'category_id' => (int)$product['category_id'],
                            ]

        );
    }


    /**
     * Обновление информации о товаре (админка)
     * @param $product <p>товары</p>
     * @param $id <p>идентификатор товара</p>
     * @return bool
     */
    public static function update($product, $id)
    {
        $product['title']        = htmlspecialchars($product['title']);
        $product['meta_d']       = htmlspecialchars($product['meta_d']);
        $product['meta_k']       = htmlspecialchars($product['meta_k']);
        $product['img']          = htmlspecialchars($product['img']);
        $product['name']         = htmlspecialchars($product['name']);
        $product['brand']        = htmlspecialchars($product['brand']);
        $product['availability'] = (int)$product['availability'];
        $product['price']        = (int)$product['price'];
        $product['description']  = htmlspecialchars($product['description']);
        $product['priority']     = (int)$product['priority'];
        $product['status']       = (int)$product['status'];
        $product['category_id']  = (int)$product['category_id'];

        $id = (int)$id;

        return self::run('UPDATE ' . self::$table . ' '
                            .'SET title = :title, meta_d = :meta_d, meta_k = :meta_k, img = :img,
                            name = :name, brand = :brand, availability = :availability, price = :price,
                            description = :description, priority = :priority, status = :status, 
                            category_id = :category_id '
                            .'WHERE id = :id ',
                            [
                                'title' => $product['title'], 'meta_d' => $product['meta_d'],
                                'meta_k' => $product['meta_k'], 'img' => $product['img'],
                                'name' => $product['name'], 'brand' => $product['brand'],
                                'availability' => $product['availability'], 'price' =>(int)$product['price'],
                                'description' => $product['description'], 'priority' => (int)$product['priority'],
                                'status' => (int)$product['status'], 'category_id' => (int)$product['category_id'],
                                'id' => (int)$id
                            ]

        )->execute();
    }

    /**
     * Удаление товара (админка)
     * @param $id <p>Идентификатор товара</p>
     * @return \PDOStatement
     */
    public static function delete($id)
    {
        $id = (int)$id;
        return self::run('DELETE FROM ' . self::$table . ' WHERE id = :id', ['id' => $id]);
    }

}