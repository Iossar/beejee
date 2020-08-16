<?php


namespace app\Models;


class View
{
    public $layout = '../app/Views/layout.php';

    public static function render($__data) {
        $view = '../app/Views/layout.php';
        extract($__data);

        ob_start();

        require $view;
        $output = ob_get_clean();

        return $output;
    }

    public static function block($__view, $__data)
    {
        $view = '../app/Views/' . $__view .'.php';
        extract($__data);

        ob_start();

        require $view;

        $output = ob_get_clean();

        return $output;
    }
}
