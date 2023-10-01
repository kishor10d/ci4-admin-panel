<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table = 'tbl_users';
    protected $allowedFields = ['email', 'password', 'name', 'mobile', 'roleId', 'isAdmin', 'updatedBy', 'updatedDtm'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)  {
        return $data;
    }

    protected function beforeUpdate(array $data)  {
        return $data;
    }
}