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
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
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

    public function update($data)
    {
        $sql = "UPDATE $this->table SET ";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= $key . " = " . $value . ", ";
        }
        $sql = substr($sql, 0, -2);

        return $sql;
    }

    public function whereIn($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " IN (" . $value . ") AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function whereOr($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " = " . $value . " OR";
        }
        $sql = substr($sql, 0, -3);

        return $sql;
    }

    public function whereNotIn($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " NOT IN (" . $value . ") AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function whereBetween($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " BETWEEN " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function whreNotEqual($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " != " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function whereLike($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " LIKE " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function whereNotLike($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " NOT LIKE " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function whereNull($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " IS NULL AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function whereNotNull($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " IS NOT NULL AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function whereGreaterThan($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " > " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function whereLessThan($data)
    {
        $sql = " WHERE";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " < " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function or($data)
    {
        $sql = " OR";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " = " . $value . " OR";
        }
        $sql = substr($sql, 0, -3);

        return $sql;
    }

    public function orNotEqual($data)
    {
        $sql = " OR";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " != " . $value . " OR";
        }
        $sql = substr($sql, 0, -3);

        return $sql;
    }

    public function orLike($data)
    {
        $sql = " OR";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " LIKE " . $value . " OR";
        }
        $sql = substr($sql, 0, -3);

        return $sql;
    }

    public function orNotLike($data)
    {
        $sql = " OR";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " NOT LIKE " . $value . " OR";
        }
        $sql = substr($sql, 0, -3);

        return $sql;
    }

    public function orNull($data)
    {
        $sql = " OR";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " IS NULL OR";
        }
        $sql = substr($sql, 0, -3);

        return $sql;
    }

    public function orNotNull($data)
    {
        $sql = " OR";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " IS NOT NULL OR";
        }
        $sql = substr($sql, 0, -3);

        return $sql;
    }

    public function orGreaterThan($data)
    {
        $sql = " OR";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " > " . $value . " OR";
        }
        $sql = substr($sql, 0, -3);

        return $sql;
    }

    public function orLessThan($data)
    {
        $sql = " OR";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " < " . $value . " OR";
        }
        $sql = substr($sql, 0, -3);

        return $sql;
    }

    public function orderBy($data)
    {
        $sql = " ORDER BY";
        foreach ($data as $key => $value) {
            $sql .= " " . $key . " " . $value . ",";
        }
        $sql = substr($sql, 0, -1);

        return $sql;
    }

    public function groupBy($data)
    {
        $sql = " GROUP BY";
        foreach ($data as $key => $value) {
            $sql .= " " . $value . ",";
        }
        $sql = substr($sql, 0, -1);

        return $sql;
    }

    public function limit($data)
    {
        $sql = " LIMIT";
        foreach ($data as $key => $value) {
            $sql .= " " . $value . ",";
        }
        $sql = substr($sql, 0, -1);

        return $sql;
    }

    public function offset($data)
    {
        $sql = " OFFSET";
        foreach ($data as $key => $value) {
            $sql .= " " . $value . ",";
        }
        $sql = substr($sql, 0, -1);

        return $sql;
    }

    public function join($data)
    {
        $sql = "";
        foreach ($data as $key => $value) {
            $sql .= " " . $value['type'] . " JOIN " . $value['table'] . " ON " . $value['first'] . " = " . $value['second'];
        }

        return $sql;
    }

    public function and($data)
    {
        $sql = " AND";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " = " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function andNotEqual($data)
    {
        $sql = " AND";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " != " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function andLike($data)
    {
        $sql = " AND";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " LIKE " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function andNotLike($data)
    {
        $sql = " AND";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " NOT LIKE " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function andNull($data)
    {
        $sql = " AND";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " IS NULL AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function andNotNull($data)
    {
        $sql = " AND";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " IS NOT NULL AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function andGreaterThan($data)
    {
        $sql = " AND";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " > " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }

    public function andLessThan($data)
    {
        $sql = " AND";
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            } else if (is_null($value)) {
                $value = "NULL";
            }
            $sql .= " " . $key . " < " . $value . " AND";
        }
        $sql = substr($sql, 0, -4);

        return $sql;
    }
}
