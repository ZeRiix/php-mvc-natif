<?php

namespace App\Services;

use App\Core\DatabaseConnection;
use App\Models\UserModel;
use App\Core\AutoLoad;

class TestServices
{
    public $db;

    public $user;

    public function __construct()
    {
        $this->db = new DatabaseConnection();
        $load = new AutoLoad();
        $load->addDirectory('Models');
        $load->register();
        $this->user = new UserModel();
    }

    public function test()
    {
        return 'test';
    }

    public function insertUser($data)
    {
        $sql = $this->user->insert($data);
        $this->user->exec($sql);
    }

    public function getAllUser()
    {
        return $this->user->getAll();
    }

    public function getAllUserWhere($data)
    {
        $sql = $this->user->select(['id', 'name', 'email']);
        $sql .= $this->user->where($data);

        return $this->user->exec($sql);
    }

    public function deleteUser($data)
    {
        $sql = $this->user->delete();
        $sql .= $this->user->where($data);
        $this->user->exec($sql);
    }

    
}