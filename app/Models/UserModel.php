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

    public function getUsers()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $query = $builder->select('userId, email, name, mobile, createdDtm')
            ->getWhere(['isDeleted'=>0]);

        return $query->getResult();
    }
}