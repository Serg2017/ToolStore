<?php
/**
 * Контроллер AdminUserController
 */

namespace app\controllers;
use app\components\AdminBase;
use app\models\User;


class AdminUserController extends AdminBase
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
     * Action главной страницы пользователей (вывод все пользователей)
     * @return mixed
     */
    public function actionIndex()
    {
        $users = User::getUsers();

        $data = [
            'title' => 'Главная страница Суперпользователя',
            'users' => $users,
        ];

        return $this->view->view('template/admin_template', 'admin_user/index', $data);
    }


    /**
     * Action добавление нового пользователя
     * @return mixed
     */
    public function actionAdd()
    {
        $user['name']       = '';
        $user['email']      = '';
        $user['password']   = '';
        $user['rePassword'] = '';
        $user['role']       = '';

        $errors = false;
        $result = false;

        if(isset($_POST['submit'])) {

            $user['name']       = $_POST['name'];
            $user['email']      = $_POST['email'];
            $user['password']   = $_POST['password'];
            $user['rePassword'] = $_POST['rePassword'];
            $user['role']       = $_POST['role'];

            if (!User::checkName($user['name'])) {
                $errors[] = 'Имя должно состять минимум из 3 символов и не содержать цыфр';
            }

            if (!User::checkEmail($user['email'])) {
                $errors[] = 'Некорректные email';
            }

            if (!User::checkPassword($user['password'])) {
                $errors[] = 'Некорректный пароль (пароль должен состоять минимум из 5 символов)';
            }

            if (!User::passwordsMatch($user['password'], $user['rePassword'])) {
                $errors[] = 'Пароли не совпадают';
            }

            if (User::emailExists($user['email'])) {
                $errors[] = 'Пользователь с данным Email зарегистрирован в системе';
            }

            if($errors == false) {
                $result = User::registration($user);
                if($result) {
                    header('Location: /admin/user/add');
                }
            }
        }

        $data = [
            'title'  => 'Добавление нового пользователя',
            'errors' => $errors,
        ];

        return $this->view->view('template/admin_template', 'admin_user/add', $data);
    }


    /**
     * Action обновление информации пользователя
     * @param $id <p>Идентификатор пользователя</p>
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $userData = User::getUserInfo($id);

        $user['name']       = $userData['name'];
        $user['email']      = $userData['email'];
        $user['password']   = '';
        $user['rePassword'] = '';
        $user['role']       = $userData['role'];

        $errors = false;
        $result = false;

        if(isset($_POST['submit'])) {

             $user['name']       = $_POST['name'];
             $user['email']      = $_POST['email'];
             $user['password']   = $_POST['password'];
             $user['rePassword'] = $_POST['rePassword'];
             $user['role']       = $_POST['role'];

            if (!User::checkName($user['name'])) {
                $errors[] = 'Имя должно состять минимум из 3 символов и не содержать цыфр';
            }

            if (!User::checkEmail($user['email'])) {
                $errors[] = 'Некорректные email';
            }

            if (!User::checkPassword($user['password'])) {
                $errors[] = 'Некорректный пароль (пароль должен состоять минимум из 5 символов)';
            }

            if (!User::passwordsMatch($user['password'], $user['rePassword'])) {
                $errors[] = 'Пароли не совпадают';
            }

            if (User::emailExists($user['email'], $id)) {
                $errors[] = 'Пользователь с данным Email зарегистрирован в системе';
            }

            if($errors == false) {
                $result = User::update($user, $id);
                if($result) {
                    header('Location: ' . $_SERVER['HTTP_REFERER'] );
                }
            }
        }

        $data = [
            'title'  => 'Главная страница Суперпользователя',
            'errors' => $errors,
            'user'   => $user
        ];

        return $this->view->view('template/admin_template', 'admin_user/edit', $data);
    }

    /**
     * Action удаление пользователя
     * @param $id <p>Идентификатор пользователя</p>
     */
    public function actionDelete($id)
    {
        $result = User::delete($id);
        if($result) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}