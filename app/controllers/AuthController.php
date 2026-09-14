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
}