<?php

/**
 * Модель для работы с категориями меню
 */
namespace app\models;
use app\vendor\Model;

class Category extends Model
{

    /**
     * @var string <p>таблица для выборки</p>
     */
    private static $table = 'categories';

    /**
     * Получаем все включенные категоии меню
     * отсортированые по приоритету
     * @return array <p>категории меню</p>
     */
    public static function getCategories()
    {
        $result =  self::run('SELECT * FROM '. self::$table . ' '
                                .'WHERE status = 1 '
                                .'ORDER BY priority'
        );
        return $result->fetchAll();
    }

    /**
     * Получаем все категории меню (админка)
     * @return array
     */
    public static function getCategoriesListAdmin()
    {
        $result = self::run('SELECT * FROM '. self::$table);
        $result->execute();
        return $result->fetchAll();
    }


    /**
     * Получаем нужную категорию меню (админка)
     * @param $id <p>Идентификатор категории</p>
     * @return mixed
     */
    public static function getCategoryById($id)
    {
        $id =(int)$id;
        return self::run('SELECT title, meta_d, meta_k, name, priority, status FROM ' .self::$table . ' '
                            .'WHERE id = :id ',
                            ['id' => $id]
        )->fetch();
    }

    /**
     * Добавление новой категории меню
     * @param $category <p>Массив с данными о категории</p>
     * @return \PDOStatement
     */
    public static function addCategory($category)
    {
        $title    = $category['title'];
        $meta_d   = $category['meta_d'];
        $meta_k   = $category['meta_k'];
        $name     = $category['name'];
        $priority = (int)$category['priority'];
        $status   = (int)$category['status'];


        return self::run('INSERT INTO ' . self::$table . ' '
                            .'(title, meta_d, meta_k, name, priority, status) '
                            .'VALUE (:title, :meta_d, :meta_k, :name, :priority, :status)',
                            [
                                'title' => $title, 'meta_d' => $meta_d,
                                'meta_k' => $meta_k, 'name' => $name,
                                'priority' => $priority, 'status' => $status
                            ]

        );
    }


    /**
     * Обновление категории меню
     * @param $category <p>Массив с новыми данными о категории</p>
     * @param $id </p>идентификатор категории</p>
     * @return \PDOStatement
     */
    public static function updateCategory($category, $id)
    {
        $category['title']    = htmlspecialchars($category['title']);
        $category['meta_d']   = htmlspecialchars($category['meta_d']);
        $category['meta_k']   = htmlspecialchars($category['meta_k']);
        $category['name']     = htmlspecialchars($category['name']);
        $category['priority'] = (int)$category['priority'];
        $category['status']   = (int)$category['status'];
        $id                   = (int)$id;

        return self::run('UPDATE ' . self::$table . ' '
                            .'SET title = :title, meta_d = :meta_d, meta_k = :meta_k, '
                            .'name = :name, priority = :priority, status = :status '
                            .'WHERE id = :id',
                            [
                                'title' => $category['title'], 'meta_d' => $category['meta_d'],
                                'meta_k' => $category['meta_k'], 'name' => $category['name'],
                                'priority' => $category['priority'], 'status' => $category['status'],
                                'id' => $id
                            ]
        );
    }

    /**
     * Удаление категории
     * @param $id <p>Идентификатор категории</p>
     * @return bool
     */
    public static function deleteCategory($id)
    {
        $id = (int)$id;
        return self::run('DELETE FROM ' . self::$table . ' WHERE id = :id ', ['id' => $id])->execute();
    }

}