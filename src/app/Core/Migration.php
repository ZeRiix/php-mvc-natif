<?php

namespace App\Core;

use App\Core\DatabaseConnection;

class Migration
{
    private $db;

    private $columns = [];

    private $table = [];

    private $tableName;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
    }

    public function setNameColumns($name)
    {
        $this->columns['name'] = $name;
    }

    public function setTypeColumns($type)
    {
        $this->columns['type'] = $type;
    }

    public function setConstraintColumns($constraint)
    {
        $this->columns['constraint'] = $constraint;
    }

    public function setNullColumns($null)
    {
        $this->columns['null'] = $null;
    }

    public function setAutoIncrementColumns($auto_increment)
    {
        $this->columns['auto_increment'] = $auto_increment;
    }

    public function setPrimaryKeyColumns($primary_key)
    {
        $this->columns['primary_key'] = $primary_key;
    }

    public function setForeignKeyColumns($foreign_key)
    {
        $this->columns['foreign_key'] = $foreign_key;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    public function create()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->tableName} (";
        foreach ($this->table as $key => $value) {
            $sql .= "{$value['name']} {$value['type']} {$value['constraint']} {$value['null']} {$value['auto_increment']} {$value['primary_key']} {$value['foreign_key']},";
        }
        $sql = rtrim($sql, ',');
        $sql .= ")";
        $this->db->testConnection()->exec($sql);
    }

    public function drop()
    {
        $sql = "DROP TABLE IF EXISTS {$this->tableName}";
        return $sql;
    }

    public function save()
    {
        array_push($this->table, $this->columns);
        $this->columns = [];
    }
}