<?php
/**
 * Created by PhpStorm.
 * User: medved
 * Date: 18.05.17
 * Time: 17:06
 */

namespace app\models;
use app\vendor\Model;

class User extends Model
{
    private static $table = 'users';

    /**
     * Проверка корректности имени пользователя
     * @param $name <p>Имя</p>
     * @return bool
     */
    public static function checkName($name)
    {
        if (preg_match("/^[a-zа-я ]{3,}$/iu", $name)) {
            return true;
        }
        return false;
    }

    /**
     * Проверка корректности имени пользователя
     * @param $phone <p>Теллефон</p>
     * @return bool
     */
    public static function checkPhone($phone)
    {
        if (preg_match("/^[+0-9]{5,}$/", $phone)) {
            return true;
        }
        return false;
    }

    /**
     * Проверка корректности пароля
     * @param $password <p>Парроль</p>
     * @return bool
     */
    public static function checkPassword($password)
    {
        if (preg_match("/[0-9a-z_+-@#!&^%]{5,}+/i", $password)) {
            return true;
        }
        return false;
    }

    /**
     * Проверка совпадения паролей
     * @param $password <p>Пароль</p>
     * @param $rePassword <p>Пароль еще раз</p>
     * @return bool
     */
    public static function passwordsMatch($password, $rePassword) {
        if($password === $rePassword) {
            return true;
        }
        return false;
    }

    /**
     * Проверка корректности email
     * @param $email <p>Email</p>
     * @return bool
     */
    public static function checkEmail($email)
    {
        if(filter_var($email,  FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }


    /**
     * Проверка существования email
     * @param $email <p>Email пользователя</p>
     * @param int $id
     * @return bool
     */
    public static function emailExists($email, $id = 0) {
        $result = self::run('SELECT id FROM ' . self::$table . ' '
                                .'WHERE email = :email AND id != :id',
                                [
                                    'email' => $email, 'id' => $id
                                ]
        );
        if($result->fetchColumn()) {
            return true;
        }
        return false;
    }


    /**
     * Вход на сайт
     * @param $user <p>Массив с информацией для авторизации</p>
     * @return string <p>Идентификатор пользователя</p>
     */
    public static function enter($user)
    {
        $email    = $user['email'];
        $password = md5($user['password']);

        $result = self::run('SELECT id FROM ' . self::$table . ' '
                                .'WHERE email = :email AND password = :password',
                                [
                                    'email' => $email, 'password' => $password
                                ]
        );

        return $result->fetchColumn();
    }


    /**
     * Регистация новых пользователей
     * @param $user <p>Массив с информацией для регистрации</p>
     * @return \PDOStatement
     */
    public static function registration($user)
    {
        $user['name']     = htmlspecialchars($user['name']);
        $user['email']    = htmlspecialchars($user['email']);
        $user['password'] = htmlspecialchars($user['password']);
        $user['password'] = md5($user['password']);
        $user['role']     = (int)$user['role'];

        $result = self::run('INSERT INTO ' . self::$table . ' '
                                .'(name, email, password, role) '
                                .'VALUE(:name, :email, :password, :role)',
                                [
                                    'name' => $user['name'], 'email' => $user['email'],
                                    'password' => $user['password'], 'role' => $user['role']
                                ]

        );

        return $result;
    }


    /**
     * Запсь идентификатора пользователя в сессию
     * @param $userId <p>Идентификаторпользователя</p>
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    /**
     * Проверка является ли пользователь гостем
     * @return bool
     */
    public static function isGuest()
    {
        if(isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return false;
    }

    /**
     * Выход пользователя
     * @return bool
     */
    public static function logout()
    {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            header('Location: /');
            return true;
        }
        return false;
    }

    /**
     * Получаем информацию о пользователе
     * @param $idUser <p>Идентификатор пользователя</p>
     * @return \PDOStatement
     */
    public static function getUserInfo($idUser)
    {
        return self::run('SELECT * FROM ' . self::$table . ' '
                            .'WHERE id = :id',
                            [
                                'id' => $idUser
                            ]
        )->fetch();
    }

    /**
     * Проверка авторизации пользователя
     * @return mixed
     */
    public static function checkLogged()
    {
        if(!isset($_SESSION['user'])) {
            header('Location: /');
        }

        return $_SESSION['user'];
    }


    /**
     * Обновление информаци
     * @param $userInfo
     * @param $userId
     * @return \PDOStatement
     */
    public static function update($userInfo, $userId)
    {
        $userInfo['name']     = htmlspecialchars($userInfo['name']);
        $userInfo['email']    = htmlspecialchars($userInfo['email']);
        $userInfo['password'] = md5($userInfo['password']);
        $userInfo['userId']   = (int)$userId;
        $userInfo['role']     = (int)$userInfo['role'];
        $userId               = (int)$userId;

        $result = self::run('UPDATE ' . self::$table . ' '
            .'SET name = :name, email = :email, password = :password, role = :role '
            .'WHERE id = :userId',
            [
                'name' => $userInfo['name'], 'email' => $userInfo['email'],
                'password' => $userInfo['password'], 'role' => $userInfo['role'],
                'userId' => $userId
            ]

        );

        return $result;
    }

    /**
     * Удалегние пользователя
     * @param $id <p>Идентификатор пользователя</p>
     * @return bool
     */
    public static function delete($id) {
        $id = (int)$id;
        return self::run('DELETE FROM ' . self::$table . ' WHERE id = :id', ['id' => $id])->execute();
    }

    /**
     * Проверка роли пользователя
     * @param $userId <p>Идентификатор пользователя</p>
     * @return string
     * 0 - смертный
     * 1 - менеджер (обработка заказов)
     * 2 - administrator (редактирование)
     * 3 - mainAdministrator (обработка заказов, редактирование, изменение роли пользователя)
     */
    public static function checkRole($userId)
    {
        $userId = (int)$userId;
        $result = self::run('SELECT role FROM ' . self::$table . ' '
                                .'WHERE id = :userId',
                                [
                                    'userId' => $userId
                                ]
        );

        return $result->fetchColumn();
    }


    /**
     * Должность пользователя по номеру
     * @param $numberRole <p>Номер роли</p>
     * @return int|string
     */
    public static function getStringRole($numberRole)
    {
        $result = 0;
        switch ($numberRole) {
            case 0:
                $result = 'Пользователь';
                break;
            case 1:
                $result = 'Менеджер';
                break;
            case 2:
                $result = 'Администратор';
                break;
            case 3:
                $result = 'Главный администратор';
                break;
        }

        return $result;
    }

    /**
     * Получаем всех пользователей
     * @return array
     */
    public static function getUsers()
    {
        return self::run('SELECT id, name, email, role, date FROM ' . self::$table
        )->fetchAll();
    }


}