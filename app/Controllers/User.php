<?php

namespace App\Controllers;

use App\Controllers\Backend;
use App\Models\UserModel;

class User extends Backend
{
    protected $model;
    /**
     * This is default constructor of the class
     */
    public function __construct(){
        $this->model = new UserModel();
    }

    public function index()
    {
        $model = new UserModel();
        
        // $users = $model->select(['id', ''])
        //     ->where('isDeleted', 1)->findAll();

        $pageInfo['users'] = $model->getUsers();

        $headerInfo['plugin'] = ['dataTables'];
        $this->loadViews('users/index', $headerInfo, $pageInfo);
    }

}