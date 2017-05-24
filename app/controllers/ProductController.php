<?php
/**
 * Контроллер ProductController
 */
namespace app\controllers;
use app\models\Category;
use app\models\Product;
use app\vendor\Controller;

class ProductController extends Controller
{
    /**
     * Action ля вывода товаров по категориям
     * @param $idCat <p>Идентификатор категории</p>
     * @return mixed
     */
    public function actionCategory($idCat)
    {
        //Категории меню
        $categories = Category::getCategories();

        //Категория по id
        $categoryById = Category::getCategoryById($idCat);

        //Товары по категориям
        $productsByCategory = Product::getProductsByCategory($idCat);


        $data = [
            'title'      => $categoryById['title'],
            'name'       => $categoryById['name'],
            'meta_d'     => $categoryById['meta_d'],
            'meta_k'     => $categoryById['meta_k'],
            'categories' => $categories,
            'products'   => $productsByCategory,
        ];

        return $this->view->view('template/main_template', 'product/category', $data);
    }


    /**
     * Action подробного просмотра товара
     * @param $idProduct <p>Идентификатор товара</p>
     * @return mixed
     */
    public function actionView($idProduct) {

        //Категории меню
        $categories = Category::getCategories();

        //Информация по определенному товару
        $productsById = Product::getProductById($idProduct);

        //Доступность товара (в строковом представлении)
        $availability = Product::getAvailability($productsById['availability']);

        $data = [
            'categories'          => $categories,
            'title'               => $productsById['title'],
            'meta_d'              => $productsById['meta_d'],
            'meta_k'              => $productsById['meta_k'],
            'product'             => $productsById,
            'productAvailability' => $availability,
        ];

        return $this->view->view('template/main_template', 'product/view', $data);
    }
}