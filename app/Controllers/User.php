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
        //$headerInfo['plugin'] = ['dataTables'];
        $perPage = 5;
        $page = (@$_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page-1) * $perPage;

        print_r($offset);
        print_r($page);

        $model = new UserModel();

        $recordCount = $model->userListingCount();

        // print_r($recordCount); die;

        $pager = service('pager');

        $userRecords = $model->userListing($perPage, $offset);

        print_r($userRecords); die;

        $data = [
            'data'=>$userRecords,
            'links' => $pager->makeLinks($page, $perPage, $recordCount)
        ];

        $this->loadViews('users/index', [], $data);
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

    /**
     * Loads user create page
     */
    public function create()
    {   
        $this->loadViews('users/create');
    }

    /**
     * Loads user edit page
     */
    public function edit($userId = NULL)
    {
        if ($userId == NULL || $userId == 0) {
            return redirect()->to('users');
        }

        $model = new UserModel();

        $user = $model->getUserById($userId);

        pre($user); die;

        $this->loadViews('users/edit');
    }
}