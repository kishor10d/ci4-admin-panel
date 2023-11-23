<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            
            $rules = [
                'email' => 'required|min_length[6]|max_length[60]|valid_email',
                'password' => 'required|min_length[5]|max_length[255]|validateUser[email, password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Email or Password don\'t match'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();

                $user = $model->where('email', $this->request->getVar('email'))
                        ->first();

                $this->setUser($user);

                return redirect()->to('dashboard');
            }
        }

        // $this->isLoggedIn();

        if($this->isLoggedIn()) {
            return redirect()->to('dashboard');
        } else {
            echo view('users/login', $data);
        }
    }

    private function setUser($user) {
        
        $sessionArray = array('userId'=>$user['userId'],
                        'role'=>$user['roleId'],
                        'name'=>$user['name'],
                        'isAdmin'=>$user['isAdmin'],
                        'isLoggedIn' => TRUE
                    );
        
        session()->set($sessionArray);
        return true;
    }

    private function isLoggedIn()
    {
        $isLoggedIn = session()->get('isLoggedIn');

        return $isLoggedIn;
    }
}