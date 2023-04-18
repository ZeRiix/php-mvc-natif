<?php

namespace App\Controllers;

use App\Core\Controller as BaseController;
use App\Core\Response;
use App\Core\AutoLoad;
use App\Services\TestServices;

class Controller
{

    public $autoload;
    public $testServices;
    public $r;

    public function __construct()
    {
        $this->autoload = new AutoLoad();
        $this->autoload->addDirectory('Services');
        $this->autoload->register();
        $this->testServices = new TestServices();
        $this->r = new Response();
    }

    public function test()
    {
        return $this->r->HTTPResponse(200, 'successfully', [
            'message' => 'Hello World',
            'data' => $this->testServices->test()
        ]);
    }

    public function test2($param)
    {
        return $this->r->HTTPResponse(200, 'successfully', $param['top']);
    }

    public function insertUser($param)
    {
        try {
            $this->testServices->insertUser($param['data']);
            return $this->r->HTTPResponse(200, 'successfully', [
                'message' => 'Insert successfully',
            ]);
        } catch (\Exception $e) {
            return $this->r->HTTPResponse(500, 'error', [
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function getAllUser()
    {
        try {
            $test = $this->testServices->getAllUser();
            return $this->r->HTTPResponse(200, 'successfully', [
                'message' => 'Get all successfully',
                'data' => $test
            ]);
        } catch (\Exception $e) {
            return $this->r->HTTPResponse(500, 'error', [
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function getAllUserWhere($data)
    {
        try {
            $test = $this->testServices->getAllUserWhere($data['data']);
            return $this->r->HTTPResponse(200, 'successfully', [
                'message' => 'Get all successfully',
                'data' => $test
            ]);
        } catch (\Exception $e) {
            return $this->r->HTTPResponse(500, 'error', [
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function deleteUser($data)
    {
        try {
            $this->testServices->deleteUser($data['data']);
            return $this->r->HTTPResponse(200, 'successfully', [
                'message' => 'Delete successfully',
            ]);
        } catch (\Exception $e) {
            return $this->r->HTTPResponse(500, 'error', [
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }

    public function updateUserWhere($data)
    {
        try {
            $this->testServices->updateUserWhere($data['data'], $data['where']);
            return $this->r->HTTPResponse(200, 'successfully', [
                'message' => 'Update successfully',
            ]);
        } catch (\Exception $e) {
            return $this->r->HTTPResponse(500, 'error', [
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }
}