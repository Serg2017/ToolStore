<?php

/**
 * Created by PhpStorm.
 * User: medved
 * Date: 26.04.17
 * Time: 21:06
 */

namespace app\vendor;

class View
{

    /**
     * @var string <p>здесь можно указать общий вид по умолчанию</p>
     */
    private $templateView;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->templateView = 'default';
    }

    /**
     * @param string $templateFile <p>общий для всех страниц шаблон</p>
     * @param null $contentView <p>виды отображающие контент страниц</p>
     * @param null $data <p>массив, содержащий элементы контента страницы. Обычно заполняется в модели</p>
     * @return mixed
     */
    public function view($templateFile = null, $contentView = null, $data = null)
    {
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }

        if($contentView != null) {
            $contentView = ROOT . 'views/' . $contentView . '.php';
        }

        return include ROOT . 'views/' . $templateFile . '.php';
    }



}