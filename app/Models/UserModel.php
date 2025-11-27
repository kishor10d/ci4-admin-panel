<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table = 'tbl_users';
    protected $primaryKey = 'userId';
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

    public function getUsersArray()
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $query = $builder->select('userId, email, name, mobile, createdDtm')
            ->getWhere(['isDeleted'=>0]);

        return $query->getResult('array');
    }

    public function userListingCount($searchText = '') {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select('userId, email, name, mobile, createdDtm');
        if(!empty($searchText)) {
            $builder->orLike('email', $searchText);
            $builder->orLike('name', $searchText);
            $builder->orLike('mobile', $searchText);
        }
        $builder->getWhere(['isDeleted'=>0]);

        return $builder->countAllResults();
    }

    public function userListing($page, $segment, $searchText = '') {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select('userId, email, name, mobile, createdDtm');
        // if(!empty($searchText)) {
        //     $builder->orLike('email', $searchText);
        //     $builder->orLike('name', $searchText);
        //     $builder->orLike('mobile', $searchText);
        // }
        $builder->where(['isDeleted'=>0]);
        // $builder->limit($page, $segment);
        $query = $builder->get();

        return $query->getResult();
    }

    public function getUserById($userId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $query = $builder->select('userId, email, name, mobile, createdDtm')
            ->getWhere(['userId'=>$userId,'isDeleted'=>0]);

        return $query->getResult();
    }
}