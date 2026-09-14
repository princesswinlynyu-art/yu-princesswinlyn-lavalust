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
        try
        {
            $this->call->model('AccountModel');

            $data = array(
                'fullname' => $_POST['fullname'],
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            );

            $this->AccountModel->insert($data);
        }
        catch (Throwable $exception)
        {
            http_response_code(500);
            echo '<h2>Registration failed</h2><p>Please verify that the accounts table exists in the database.</p>';
            return;
        }

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
            $this->session->sess_regenerate(true);
            $this->session->set_userdata([
                'logged_in' => true,
                'user_id' => $user['id'],
                'username' => $user['username']
            ]);

            header('Location: ' . base_url() . 'products');
            exit;
        }

        echo '<h2>Invalid Username or Password</h2>';
    }

    public function logout()
    {
        $this->session->sess_destroy();

        header('Location: ' . base_url() . 'login');
        exit;
    }
}