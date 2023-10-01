<?php

namespace App\Controllers;

use App\Controllers\Backend;
use App\Models\UserModel;

class Dashboard extends Backend
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        
    }

    public function index() {
        echo "login success";
    }
}