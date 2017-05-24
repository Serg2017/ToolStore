<?php
/**
 * Created by PhpStorm.
 * User: medved
 * Date: 26.04.17
 * Time: 23:01
 * Аавтозагрузчик классов
 */

namespace app\vendor;


class Autoloader
{

    // карта для соответствия неймспейса пути в файловой системе
    protected $namespacesMap = array();

    public function addNamespace($namespace, $rootDir)
    {
        if (is_dir($rootDir)) {
            $this->namespacesMap[$namespace] = $rootDir;
            return true;
        }

        return false;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    protected function autoload($class)
    {
        $pathParts = explode('\\', $class);

        if (is_array($pathParts)) {
            $namespace = array_shift($pathParts);

            if (!empty($this->namespacesMap[$namespace])) {
                $filePath = $this->namespacesMap[$namespace] . '/' . implode('/', $pathParts) . '.php';
                //echo $filePath . ' - autoload<br>';
                require_once $filePath;
                return true;
            }
        }

        return false;
    }

}