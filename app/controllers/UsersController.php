<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller
{
    public function index()
    {
        $this->call->model('UsersModel');

        $users = $this->UsersModel->all();

        $data['users'] = $users;

        $this->call->view('users_view', $data);
    }
}