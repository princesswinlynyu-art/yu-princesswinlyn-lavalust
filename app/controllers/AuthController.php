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
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }

        $this->call->model('AccountModel');

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->AccountModel->getByUsername($username);

        if ($user && password_verify($password, $user['password']))
        {
            session_regenerate_id(true);
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
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }

        $_SESSION = array();
        session_destroy();

        header('Location: ' . base_url() . 'login');
        exit;
    }

    public function testSession()
    {
        echo '<pre>';
        print_r($_SESSION);
    }
}