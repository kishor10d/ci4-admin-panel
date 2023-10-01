<?php

namespace App\Controllers;

use App\Controllers\Backend;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        
    }

    public function index() {
        // echo view('templates/header');
        // echo view('general/dashboard');
        // echo view('templates/footer');

        // $this->loadViews('general/dashboard');

        echo "dasbord"; 
    }
}