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
        $this->call->model('AccountModel');

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->AccountModel->getByUsername($username);

        if ($user && password_verify($password, $user['password']))
        {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header('Location: ' . base_url() . 'products');
            exit;
        }

        echo "<h2>Invalid Username or Password</h2>";
    }

    public function logout()
    {
        session_destroy();

        header('Location: ' . base_url() . 'login');
        exit;
    }
}