<?php

namespace App\Core;

class View
{
    private $template;
    private $data;

    public function __construct(string $template, array $data = [])
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function render() : string
    {
        ob_start();
        extract($this->data);
        include __DIR__ . '/../Views/' . $this->template . '.php';
        return ob_get_clean();
    }
}
