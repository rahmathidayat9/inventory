<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home/login');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $find_user = $this->db->table('users')
            ->where('username', $username)
            ->get()
            ->getRowArray();
        
        if ($find_user) {
            if (password_verify($password, $find_user['password'])) {
                $this->session->set('user_id', $find_user['id']);
                
                if ($find_user) {
                    return redirect('dashboard');    
                }
            } else {
                $this->session->setFlashdata('error', 'Password salah!');
                return redirect('/');                
            }
        } else {
            $this->session->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect('/');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect('/');
    }
}
