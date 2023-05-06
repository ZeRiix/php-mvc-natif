<?php

namespace App\Core;

use App\Core\DatabaseConnection as Database;

use function PHPSTORM_META\type;

abstract class Model
{
    protected $db;

    private String $table;

    private Array $columns;

    public Array $data;

    public String $sql;

    public function __construct(String $table)
    {
        $this->db = new Database();
        $this->table = $table;
        $this->columns = $this->getColums($this->table);
        $this->setKeyData();

    }

    private function getColums(String $table)
    {
        $this->sql = "SHOW COLUMNS FROM $table";
        return $this->exec();
    }

    public function setKeyData(): void
    {
        foreach ($this->columns as $key => $value) {
            $this->data[$value['Field']] = [];
        }
    }

    public function set($data): object
    {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->data)) {
                $this->data[$key] = $value;
            } else {
                throw new \Exception("Column $key not found");
            }
        }
        return $this;
    }

    public function exec()
    {
        try {
            $stmt = $this->db->db->prepare($this->sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }   

        return $result;
    }

    public function printColumns(): Array
    {
        return $this->columns;
    }

    public function get(mixed $column = null): object
    {
        if ($column != null)
        {
            if (gettype($column) == 'string') 
            {
                $this->sql = "SELECT $column FROM $this->table";
            } 
            else if (gettype($column) == 'array') 
            {
                $this->sql = "SELECT ";
                $this->sql .= implode(',', $column);
                $this->sql .= " FROM $this->table";
            } else {
                throw new \Exception('Column must be string or array');
            }
        } else {
            $this->sql = "SELECT * FROM $this->table";
        }

        return $this;
    }

    public function create(): Array
    {
        $this->sql = "INSERT INTO $this->table (";
        foreach($this->data as $key => $value) {
            if ($value != null) {
                $this->sql .= "$key, ";
            }
        }
        $this->sql = substr($this->sql, 0, -2);
        $this->sql .= ") VALUES (";
        foreach($this->data as $key => $value) {
            if ($value != null) {
                $this->sql .= "'$value', ";
            }
        }
        $this->sql = substr($this->sql, 0, -2);
        $this->sql .= ")";

        return $this->exec();
    }

    public function where($colums, $operator, $value): object
    {
        if (gettype($value) == 'string' or gettype($value) == 'integer' and 
            gettype($operator) == 'string' and 
            gettype($colums) == 'string') 
        {
            if (strpos($this->sql, 'WHERE') == false) 
            {
                $this->sql .= " WHERE $colums $operator '$value'";
            } else 
            {
                if (strpos($this->sql, '=') == false) 
                {
                    if ($operator == '=')
                    {
                        $this->sql .= " OR $colums $operator '$value'";
                        print('1');
                    } else 
                    {
                        $this->sql .= " AND $colums $operator '$value'";
                    }
                } else 
                {
                    print($this->sql);
                    $this->sql .= " OR $colums $operator '$value'";
                }
            }
        }

        return $this;
    }

    public function first()
    {
        $this->sql .= " LIMIT 1";
        return $this;
    }

    public function delete(): object
    {
        $this->sql = "DELETE FROM $this->table";
        return $this;
    }

    public function update(): Array
    {
        $this->sql = "UPDATE $this->table SET ";
        $this->sql .= implode(', ', array_map(function ($key, $value) {
            return "$key = '$value'";
        }, array_keys($this->data), $this->data));
        $this->sql .= " WHERE {$this->columns[0]['Field']} = " . $this->data[$this->columns[0]['Field']];

        //die($this->sql);
        return $this->exec();
    }

    public function save(): Array
    {
        //(var_dump(array_key_exists($this->columns[0]['Field'], $this->data)));
        if (array_key_exists($this->columns[0]['Field'], $this->data) == false)
        {
            return $this->create();
        } else 
        {
            return $this->update();
        }
    }

    
}