<?php
/**
 * Контроллер AdminCategoryController
 */

namespace app\controllers;
use app\components\AdminBase;
use app\models\Category;

class AdminCategoryController extends AdminBase
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
     * Action главной страницы
     * @return mixed
     */
    public function actionIndex()
    {
        //Категории меню
        $categories = Category::getCategoriesListAdmin();

        $data = [
            'title' => 'Категории',
            'categories' => $categories,
        ];

        return $this->view->view('template/admin_template', 'admin_category/index', $data);
    }

    /**
     * Action добавление новой категории меню
     * @return mixed
     */
    public function actionAdd()
    {

        $category['title']    = '';
        $category['meta_d']   = '';
        $category['meta_k']   = '';
        $category['name']     = '';
        $category['priority'] = '';
        $category['status']   = 1;

        $errors = false;
        $result = false;

        if(isset($_POST['submit'])) {
            $category['title']    = $_POST['title'];
            $category['meta_d']   = $_POST['meta_d'];
            $category['meta_k']   = $_POST['meta_k'];
            $category['name']     = $_POST['name'];
            $category['priority'] = $_POST['priority'];
            $category['status']   = $_POST['status'];

            if (empty($category['title'])) {
                $errors[] = 'Поле Title должно быть заполнено';
            }

            if (empty($category['meta_d'])) {
                $errors[] = 'Поле Description должно быть заполнено';
            }

            if (empty($category['meta_k'])) {
                $errors[] = 'Поле Keywords должно быть заполнено';
            }

            if (empty($category['name'])) {
                $errors[] = 'Поле Название категории должно быть заполнено';
            }

            if ($errors == false) {

                $result = Category::addCategory($category);
                if ($result) {
                    header('Location: '  . $_SERVER['HTTP_REFERER']);
                }
            }
        }

        $data = [
            'title' => 'Добавление новой категории',
            'errors' => $errors,
        ];

        return $this->view->view('template/admin_template', 'admin_category/add', $data);
    }


    /**
     * Action обновление информации определеноой категории
     * @param $id <p>Идентификатор категории</p>
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //Категории меню
        $cat = Category::getCategoryById($id);

        $category['title']    = $cat['title'];
        $category['meta_d']   = $cat['meta_d'];
        $category['meta_k']   = $cat['meta_k'];
        $category['name']     = $cat['name'];
        $category['priority'] = $cat['priority'];
        $category['status']   = $cat['status'];

        $errors = false;
        $result = false;

        if(isset($_POST['submit'])) {
            $category['title']    = $_POST['title'];
            $category['meta_d']   = $_POST['meta_d'];
            $category['meta_k']   = $_POST['meta_k'];
            $category['name']     = $_POST['name'];
            $category['priority'] = $_POST['priority'];
            $category['status']   = $_POST['status'];

            if (empty($category['title'])) {
                $errors[] = 'Поле Title должно быть заполнено';
            }

            if (empty($category['meta_d'])) {
                $errors[] = 'Поле Description должно быть заполнено';
            }

            if (empty($category['meta_k'])) {
                $errors[] = 'Поле Keywords должно быть заполнено';
            }

            if (empty($category['name'])) {
                $errors[] = 'Поле Название категории должно быть заполнено';
            }


            if ($errors == false) {
                $result = Category::updateCategory($category, $id);
                if ($result) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }

        $data = [
            'title'    => 'Добавление новой категории',
            'errors'   => $errors,
            'category' => $category,
        ];

        return $this->view->view('template/admin_template', 'admin_category/update', $data);
    }


    /**
     * Action удаление категории
     * @param $id <p>Идентификатор категории</p>
     * @return bool
     */
    public function actionDelete($id)
    {
        $result = Category::deleteCategory($id);
        if ($result) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        return false;
    }
}