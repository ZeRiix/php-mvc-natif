<?php

namespace App\Core;

use Core\View;

class Controller
{

    protected View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function render(string $template, array $data = []) : string
    {
        return $this->view->render($template, $data);
    }
}