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

    public function testInsert($param)
    {
        try {
            $this->testServices->testInsert($param['table'], $param['data']);
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

    public function getAll($table)
    {
        try {
            $test = $this->testServices->getAll($table);
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
}