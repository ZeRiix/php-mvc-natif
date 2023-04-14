<?php

namespace App\Core;

abstract class Model {


    private $table;

    private $db;

    public function __construct($table)
    {
        $this->table = $table;
    }
}
