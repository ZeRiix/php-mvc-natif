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
        $load = new AutoLoad();
        $load->addDirectory('Models');
        $load->register();
        $this->user = new UserModel();
    }

    public function test() : string
    {
        return 'test';
    }

    /*
    *  @Array $data = [
    *       'name' => 'Pedro',
    *       'email' => 'pedro@mail.com,
    *       'password' => '123456'
    *   ]
    *  @return void
    */
    public function insertUser($data) : void
    {
        $sql = $this->user->insert($data);
        $this->user->exec($sql);
    }

    /*
    *  @return Array
    */
    public function getAllUser() : array 
    {
        return $this->user->getAll();
    }

    /*
    *  @Array $data = [
    *       'name' => 'Pedro'
    *   ]
    *  @return Array
    */
    public function getAllUserWhere($data) : array
    {
        $sql = $this->user->select(['id', 'name', 'email']);
        $sql .= $this->user->where($data);

        return $this->user->exec($sql);
    }

    /*
    *  @Array $data = [
    *       'id' => 1
    *   ]
    *  @return void
    */
    public function deleteUser($data) : void
    {
        $sql = $this->user->delete();
        $sql .= $this->user->where($data);
        $this->user->exec($sql);
    }

    /*
    *  @Array $data = [
    *       'email' => 'pedro1234@mail.com'
    *   ]
    *  @Array $where = [
    *       'id' => 1
    *   ]
    *  @return void
    */
    public function updateUserWhere($data, $where) : void
    {
        $sql = $this->user->update($data);
        $sql .= $this->user->where($where);
        $this->user->exec($sql);
    }
}