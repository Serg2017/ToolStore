<?php
/**
 * Controller AdminProductController
 */

namespace app\controllers;
use app\components\AdminBase;
use app\models\Category;
use app\models\Product;

class AdminProductController extends AdminBase
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
     * Action главной страницы товаров
     * @return mixed
     */
    public function actionIndex()
    {
        //Получаем все товары
        $products = Product::getProducts();

        $data = [
            'title' => 'Главная страница Суперпользователя',
            'products' => $products,
        ];

        return $this->view->view('template/admin_template', 'admin_product/index', $data);
    }

    /**
     * Action добавление нового товара
     * @return mixed
     */
    public function actionAdd()
    {
        //Категории меню
        $categories = Category::getCategoriesListAdmin();

        $product['title']        = '';
        $product['meta_d']       = '';
        $product['meta_k']       = '';
        $product['img']          = '';
        $product['name']         = '';
        $product['brand']        = '';
        $product['availability'] = '';
        $product['price']        = '';
        $product['description']  = '';
        $product['priority']     = '';
        $product['status']       = '';
        $product['category_id']  = '';

        $errors = false;
        $result = false;

        if(isset($_POST['submit'])) {
            $product['title']        = $_POST['title'];
            $product['meta_d']       = $_POST['meta_d'];
            $product['meta_k']       = $_POST['meta_k'];
            $product['img']          = $_POST['img'];
            $product['name']         = $_POST['name'];
            $product['brand']        = $_POST['brand'];
            $product['availability'] = $_POST['availability'];
            $product['price']        = $_POST['price'];
            $product['description']  = $_POST['description'];
            $product['priority']     = $_POST['priority'];
            $product['status']       = $_POST['status'];
            $product['category_id']  = $_POST['category_id'];

            if (empty($product['title'])) {
                $errors[] = 'Поле Title должно быть заполнено';
            }

            if (empty($product['meta_d'])) {
                $errors[] = 'Поле Description должно быть заполнено';
            }

            if (empty($product['meta_k'])) {
                $errors[] = 'Поле Keywords должно быть заполнено';
            }

            if (empty($product['img'])) {
                $errors[] = 'Выбирите изображение';
            }

            if (empty($product['name'])) {
                $errors[] = 'Поле Название должно быть заполнено';
            }

            if (empty($product['status'])) {
                $errors[] = 'Поле Статус должно быть заполнено';
            }

            if (empty($product['category_id'])) {
                $errors[] = 'Выбирете категорию меню';
            }

            if ($errors == false) {
                $result = Product::add($product);
                if ($result) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }

        $data = [
            'title'      => 'Добавление нового товара',
            'errors'     => $errors,
            'categories' => $categories,
        ];

        return $this->view->view('template/admin_template', 'admin_product/add', $data);
    }

    /**
     * Action обновление информации о товаре в БД
     * @param $id <p>Идентификатор товара</p>
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //Категории меню
        $categories = Category::getCategoriesListAdmin();

        //Информация о товаре
        $productData = Product::getProductByIdAdmin($id);

        $product['title']        = $productData['title'];
        $product['meta_d']       = $productData['meta_d'];
        $product['meta_k']       = $productData['meta_k'];
        $product['img']          = $productData['img'];
        $product['name']         = $productData['name'];
        $product['brand']        = $productData['brand'];
        $product['availability'] = $productData['availability'];
        $product['price']        = $productData['price'];
        $product['description']  = $productData['description'];
        $product['priority']     = $productData['priority'];
        $product['status']       = $productData['status'];
        $product['category_id']  = $productData['category_id'];

        $errors = false;
        $result = false;

        if(isset($_POST['submit'])) {
            $product['title']        = $_POST['title'];
            $product['meta_d']       = $_POST['meta_d'];
            $product['meta_k']       = $_POST['meta_k'];
            $product['img']          = $_POST['img'];
            $product['name']         = $_POST['name'];
            $product['brand']        = $_POST['brand'];
            $product['availability'] = $_POST['availability'];
            $product['price']        = $_POST['price'];
            $product['description']  = $_POST['description'];
            $product['priority']     = $_POST['priority'];
            $product['status']       = $_POST['status'];
            $product['category_id']  = $_POST['category_id'];

            if (empty($product['title'])) {
                $errors[] = 'Поле Title должно быть заполнено';
            }

            if (empty($product['meta_d'])) {
                $errors[] = 'Поле Description должно быть заполнено';
            }

            if (empty($product['meta_k'])) {
                $errors[] = 'Поле Keywords должно быть заполнено';
            }

            if (empty($product['img'])) {
                $errors[] = 'Выбирите изображение';
            }

            if (empty($product['name'])) {
                $errors[] = 'Поле Название должно быть заполнено';
            }

            if (empty($product['status'])) {
                $errors[] = 'Поле Статус должно быть заполнено';
            }

            if (empty($product['category_id'])) {
                $errors[] = 'Выбирете категорию меню';
            }

            if ($errors == false) {
                $result = Product::update($product, $id);
                if ($result) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }

        $data = [
            'title'      => 'Обновление информации о товаре',
            'errors'     => $errors,
            'categories' => $categories,
            'product'    => $product
        ];

        return $this->view->view('template/admin_template', 'admin_product/update', $data);
    }

    /**
     * Action удаление товара
     * @param $id <p>Идентификатор товара</p>
     * @return bool
     */
    public function actionDelete($id)
    {
        $result = Product::delete($id);
        if($result) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        return false;
    }
}