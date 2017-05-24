<?php

/**
 * Абстрактный класс для всех контролеров которые
 * исползуются в панеле администратора
 */
namespace app\components;
use app\models\User;
use app\vendor\Controller;

abstract class AdminBase extends Controller
{
    /**
     * Метод, который проверяет права доступа в админпанель
     * @return bool
     */
    public static function checkAdmin()
    {
        //Идентификатор пользователя
        $userId = User::checkLogged();

        //Информация по конкретному пользователю
        $userInfo = User::getUserInfo($userId);

        //Роль
        $userRole = $userInfo['role'];

        if($userRole == 1 || $userRole == 2 || $userRole == 3) {
            return true;
        }

        exit('Access denied');
    }
}