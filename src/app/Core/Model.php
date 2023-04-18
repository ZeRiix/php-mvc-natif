<?php

namespace App\Core;

use App\Core\DatabaseConnection;

abstract class Model {


    private $table;

    private $db;

    public function __construct($table)
    {
        $this->table = $table;
        $this->db = new DatabaseConnection();
    }

    public function getAll()
    {
        $sql = $this->select(['*']);
        return $this->exec($sql);
    }

    public function select($data)
    {
        $sql = "SELECT";
        foreach ($data as $value) {
            $sql .= " " . $value . ",";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " FROM " . $this->table;

        return $sql;
    }

    public function where($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            $sql .= " " . $key . " = " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function exec($sql)
    {
        $db = $this->db->testConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        $sql = "INSERT INTO $this->table (";
        foreach ($data as $key => $value) {
            $sql .= $key . ", ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ") VALUES (";

        foreach ($data as $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= $value . ", ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ")";

        return $sql;
    }

    public function delete()
    {
        $sql = "DELETE FROM $this->table";

        return $sql;
    }
}
