<?php
/**
 * Created by PhpStorm.
 * User: medved
 * Date: 27.04.17
 * Time: 14:22
 * Класс для работы с БД (используем PDO)
 */

namespace app\vendor;

class DB
{
    protected static $instance = null;

    public function __construct() {}
    public function __clone() {}

    public static function instance()
    {
        $params = require ROOT . 'configs/database.php';

        if (self::$instance === null)
        {
            $opt  = array(
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => TRUE,
            );

            $dsn = "mysql:host={$params['host']}; dbname={$params['dbname']}; charset={$params['charset']}";

            $username = $params['username'];
            $password = $params['password'];

            self::$instance = new \PDO($dsn, $username, $password, $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}



























