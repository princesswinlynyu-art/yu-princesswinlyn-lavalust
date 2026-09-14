<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function index()
    {
        $this->call->view('lab5_home');
    }

    public function signup()
    {
        $this->call->view('signup');
    }

    public function login()
    {
        $this->call->view('login');
    }

    public function store()
    {
        $this->call->model('AccountModel');

        $data = array(
            'fullname' => $_POST['fullname'],
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        );

        $this->AccountModel->insert($data);

        header('Location: ' . base_url() . 'login');
        exit;
    }

    public function authenticate()
    {
    

        echo "<pre>";
        print_r($_POST);
        exit;

    }

    public function logout()
    {
        session_destroy();

        header('Location: ' . base_url() . 'login');
        exit;
    }
}