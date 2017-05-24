<?php

/**
 * Контроллер SiteController
 */
namespace app\controllers;
use app\models\Category;
use app\models\Product;
use app\vendor\Controller;

class SiteController extends Controller
{
    /**
     * Action для главной страницы сайта
     * @return mixed
     */
    public function actionIndex() {

        //Категории меню
        $categories = Category::getCategories();

        //Последние товары на сайте
        $lastProducts = Product::getLastProducts();

        $data = [
            'title'        => 'Title',
            'name'         => 'Последние товары на сайте',
            'meta_d'       => 'ToolStore description',
            'meta_k'       => 'ToolStore keywords',
            'categories'   => $categories,
            'lastProducts' => $lastProducts,
        ];

        return $this->view->view('template/main_template', 'site/index', $data);
    }

    /**
     * Action для страницы О Нас
     * @return mixed
     */
    public function actionAbout() {

        //Категории меню
        $categories = Category::getCategories();

        $data = [
            'title'      => 'О нас',
            'meta_d'     => 'О нас',
            'meta_k'     => 'О нас',
            'categories' => $categories,
            'content'    => 'ABOUT TEXT',
        ];

        return $this->view->view('template/main_template', 'site/about', $data);
    }

    /**
     * Action для страницы Контакты
     * @return mixed
     */
    public function actionContact() {

        //Категории меню
        $categories = Category::getCategories();

        $data = [
            'title'      => 'Контакты',
            'meta_d'     => 'Контакты',
            'meta_k'     => 'Контакты',
            'categories' => $categories,
            'content'    => 'CONTACT TEXT',
        ];

        return $this->view->view('template/main_template', 'site/contact', $data);
    }
}