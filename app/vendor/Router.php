<?php
/**
 * Created by PhpStorm.
 * User: medved
 * Date: 26.04.17
 * Time: 21:58
 * Маршрутизатор
 */

namespace app\vendor;

class Router
{

    /**
     * @var mixed <p>Массив с маршрутами</p>
     */
    private $routs;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->routs = require_once ROOT . 'configs/routes.php';
    }


    /**
     * Получем значения адресной строки
     * @return bool|string
     */
    private function getURI()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if(!empty($uri)) {
            return trim($uri, '/');
        }
        return false;
    }

    /**
     * Запуск маршрутизации
     */
    public function run()
    {
        $uri = $this->getURI();

        //Количество маршрутов (если оно равно 0 значит путь неверн выкидиваем error 404)
        $countPath = 0;
        $errors = false;

        //Перебираем все маршруты
        foreach($this->routs as $patternURI => $path) {
            if(preg_match("~^$patternURI$~i", $uri)){

                $countPath++;

                $internalPath = preg_replace("~$patternURI~", $path, $uri);

                $segment = explode('/', $internalPath);

                //Узнаем имя контроллера
                $controllerName = ucfirst(array_shift($segment)) . 'Controller';
                //Узнаем имя экшена
                $actionName = 'action' . ucfirst(array_shift($segment));
                //Дополнительные параметры
                $parameters = $segment;

                $controllerFile = ROOT . 'controllers/' . $controllerName . '.php';
                if(file_exists($controllerFile)) {
                    require_once $controllerFile;
                } else {
                    $errors[] = 'Файл <b>' . $controllerFile . '</b> не найден';
                }

                $controllerObject = null;
                $controllerName = 'app\controllers\\' . $controllerName;
                if(class_exists($controllerName)) {
                    $controllerObject = new $controllerName;
                } else {
                    $errors[] = 'Класс <b>' . $controllerName . '</b> в файле <b>' . $controllerFile . '</b> не найден';
                    $errorFlag = true;
                }

                if(method_exists($controllerObject, $actionName)) {
                    //$result = $controllerObject->$actionName();
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                    if($result != null) {
                        break;
                    }
                } else {
                    $errors[] = 'Метод <b>' . $actionName . '</b> в классе <b>' . $controllerName . '</b> не найден';
                }

            }
        }

        if($countPath == 0 || is_array($errors)) {
            $this->error_404($errors);
        }
    }

    /**
     * Ошибка 404
     * @param null $messages
     */
    private function error_404($messages = null)
    {

        include_once ROOT . 'views/errors/error_404.php';

        exit();
    }


}