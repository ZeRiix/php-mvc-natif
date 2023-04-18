<?php

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{

    private $table = 'user';

    public function __construct()
    {
        parent::__construct($this->table);
    }
    
}