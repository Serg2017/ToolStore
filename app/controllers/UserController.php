<?php
/**
 * Контроллер UserController
 */

namespace app\controllers;
use app\models\User;
use app\vendor\Controller;

class UserController extends Controller
{
    /**
     * Action входа на сайт
     * @return int
     */
    public function actionEnter()
    {
        $user['email']    = '';
        $user['password'] = '';

        $errors = false;
        $result = false;

        if(isset($_POST['submit'])) {

            $user['email']    = $_POST['email'];
            $user['password'] = $_POST['password'];

            if(!User::checkEmail($user['email'])) {
                $errors[] = 'Некорректные email';
            }

            if($errors == false) {

                $userId = User::enter($user);

                if($userId != false) {
                    //Заппись идентификатора в сессию
                    User::auth($userId);
                    //Перенаправление в в зависимости от роли пользователя
                    $role = User::checkRole($userId);
                    if($role == 0) {
                        header('Location: /cabinet');
                    }
                    if($role == 1 || $role == 2 || $role == 3 || $role == 4){
                        header('Location: /admin');
                    }

                } else {
                    $errors[] = 'Ошибка входа';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }

        return  0;
    }

    /**
     * Регистрация нового пользователя
     * @return int
     */
    public function actionRegistration()
    {
        $user['name']       = '';
        $user['email']      = '';
        $user['password']   = '';
        $user['rePassword'] = '';

        $errors = false;
        $result = false;

        if(isset($_POST['submit'])) {

            $user['name']        = $_POST['name'];
            $user['email']       = $_POST['email'];
            $user['password']    = $_POST['password'];
            $user['rePassword']  = $_POST['rePassword'];

            if(!User::checkName($user['name'])) {
                $errors[] = 'Имя должно состять минимум из 3 символов и не содержать цыфр';
            }

            if(!User::checkEmail($user['email'])) {
                $errors[] = 'Некорректные email';
            }

            if(!User::checkPassword($user['password'])) {
                $errors[] = 'Некорректный пароль (пароль должен состоять минимум из 5 символов)';
            }

            if(!User::passwordsMatch($user['password'], $user['rePassword'])) {
                $errors[] = 'Пароли не совпадают';
            }

            if(User::emailExists($user['mail'])) {
                $errors[] = 'Пользователь с данным Email зарегистрирован в системе';
            }

            if($errors == false) {

                $result = User::registration($user);

                if($result) {
                    $result = 'Вы успешно зарегистированны';
                    header('Location: /');
                } else {
                    $errors[] = 'Ошибка регистрации';
                }
            }

        }
        return 0;
    }

    /**
     * Выход
     * @return int
     */
    public function actionLogout()
    {
        User::logout();
        header('Location: /');
        return 0;
    }

    /**
     * Редактирование профиля
     * @return mixed
     */
    public function actionUpdate()
    {
        $userId   = User::checkLogged();
        $userName = User::getUserInfo($userId)['name'];
        $userInfo = User::getUserInfo($userId);

        $errors = false;
        $result = false;

        if(isset($_POST['submit'])) {

            $user['name']       = $_POST['name'];
            $user['email']      = $_POST['email'];
            $user['password']   = $_POST['password'];
            $user['rePassword'] = $_POST['rePassword'];

            if(!User::checkName($user['name'])) {
                $errors[] = 'Имя должно состять минимум из 3 символов и не содержать цыфр';
            }

            if(!User::checkEmail($user['email'])) {
                $errors[] = 'Некорректные email';
            }

            if(!User::checkPassword($user['password'])) {
                $errors[] = 'Некорректный пароль (пароль должен состоять минимум из 5 символов)';
            }

            if(!User::passwordsMatch($user['password'], $user['rePassword'])) {
                $errors[] = 'Пароли не совпадают';
            }

            if(User::emailExists($user['email'], $userId)) {
                $errors[] = 'Пользователь с данным Email зарегистрирован в системе';
            }

            if($errors == false) {
                $result = User::update($user, $userId);
                header('Location: '  . $_SERVER['HTTP_REFERER']);
            }
        }

        $data = [
            'title'    => 'Редактирование данных пользователя',
            'userName' => $userName,
            'userInfo' => $userInfo,
            'errors'   => $errors,
        ];

        return $this->view->view('template/cabinet_template', 'user/update', $data);
    }
}