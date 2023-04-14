<?php

namespace App\Services;

use App\Core\DatabaseConnection;

class TestServices
{
    public $db;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
    }

    public function test()
    {
        return 'test';
    }

    public function testInsert($table, $data)
    {
        if (empty($data)) {
            throw new \Exception('Data is empty');
        }
        if (empty($table)) {
            throw new \Exception('Table is empty');
        }

        $db = $this->db->testConnection();
        if(!isset($db)) {
            throw new \Exception('Database is not connected');
        }
        $sql = "INSERT INTO $table (";
        foreach ($data as $key => $value) {
            $sql .= $key . ", ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ") VALUES (";
        foreach ($data as $value) {
            $sql .= "?, ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ")";
        $stmt = $db->prepare($sql);
        $stmt->execute([$data['name'], $data['email'], $data['password']]);
    }

    public function getAll($table)
    {
        $db = $this->db->testConnection();
        $sql = "SELECT * FROM " . $table['table'];
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}