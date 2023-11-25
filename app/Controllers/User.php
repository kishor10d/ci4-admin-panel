<?php

namespace App\Controllers;

use App\Controllers\Backend;
use App\Models\UserModel;

class User extends Backend
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        
    }

    public function index()
    {
        $headerInfo['plugin'] = ['dataTables'];
        $this->loadViews('users/index', $headerInfo);
    }

}