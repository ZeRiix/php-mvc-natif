<?php

namespace App\Core;

use Config\Database;

class DatabaseConnection {

    private $con;
    
    public $db;

    public function __construct()
    {
        $this->con = (array)new Database();
        $this->con = $this->con['db'];
        $this->connect();
    }

    public function connect(): void
    {
        $this->db = new \PDO(
            $this->con['driver'] . ':host=' . $this->con['host'] . ';port=' . $this->con['port'] . ';dbname=' . $this->con['database'],
            $this->con['username'],
            $this->con['password']
        );
    }

    public function testConnection()
    {
        return $this->db;
    }
}