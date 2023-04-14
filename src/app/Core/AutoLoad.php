<?php

namespace App\Core;


class AutoLoad
{
    protected $directories = [];

    public function register() {

        spl_autoload_register(array($this, 'loadClass'));

    }
    
    public function addDirectory($directory) {

        $this->directories[] = $directory;

    }

    public function loadClass($class) {

        $class = explode('\\', $class);
        $class = end($class);

        foreach ($this->directories as $directory) {

            $file = __DIR__ . '/../' . $directory . '/' . $class . '.php';

            if(file_exists($file)) {

                require_once $file;
                return true;

            }
            return false;

        }

    }
}