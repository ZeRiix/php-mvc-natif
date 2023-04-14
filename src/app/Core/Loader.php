<?php

namespace App\Core;

class Loader {


    public static function load($class) {

        $file = __DIR__ . '/../' . 'Controllers/'. $class . '.php';

        if (file_exists($file)) {

            require_once $file;

        }

    }

}