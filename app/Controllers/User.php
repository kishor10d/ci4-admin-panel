<?php

namespace App\Controllers;

use App\Controllers\Backend;
use App\Models\UserModel;
use App\Libraries\DataTable;
use CodeIgniter\API\ResponseTrait;

class User extends Backend
{
    use ResponseTrait;
    
    protected $model;
    /**
     * This is default constructor of the class
     */
    public function __construct(){
    }

    /**
     * Loads user listing page
     */
    public function index()
    {   
        $headerInfo['plugin'] = ['dataTables'];
        $this->loadViews('users/index', $headerInfo);
    }

    /**
     * This method is used to fetch users in datatables
     */
    public function fetchUsers()
    {
        $dataTable = new DataTable();

        $columns = [
            ['name' => 'userId'],
			['name' => 'name'],
			['name' => 'email'],
            ['name' => 'mobile'],
            ['name' => 'createdDtm', 'formatter'=>'date_only']
        ];

        $response = $dataTable->process('UserModel', $columns);

        return $this->setResponseFormat('json')->respond($response);
    }
}