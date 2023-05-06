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
        try {
            $this->user->set($data)->save();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /*
    *  @return Array
    */
    public function getAllUser() : Array
    {
        try {
            return $this->user->get()->exec();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /*
    *  @Array $data = [
    *       'name' => 'Pedro'
    *   ]
    *  @return Array
    */
    public function getAllUserWhere($data) : array
    {
        try {
            $this->user->get();
            foreach ($data as $key => $value) {
                $this->user->where($key, '=', $value);
            }
            die($this->user->sql);
            return $this->user->exec();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
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