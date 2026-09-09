<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class CrudController extends Controller
{
    public function index()
    {
        $this->call->model('UsersModel');

        $data['users'] = $this->UsersModel->all();

        $this->call->view('crud_view', $data);
    }

    public function create()
    {
        $this->call->view('crud_create');
    }

    public function store()
    {
        $this->call->model('UsersModel');

        $data = array(
            'name' => $_POST['name'],
            'contact_number' => $_POST['contact_number'],
            'email' => $_POST['email']
        );

        $this->UsersModel->insert($data);

        header('Location: ' . base_url() . 'crud');
        exit;
    }

    public function edit($id)
    {
        $this->call->model('UsersModel');

        $data['user'] = $this->UsersModel->find($id);

        $this->call->view('crud_edit', $data);
    }

    public function update($id)
    {
        $this->call->model('UsersModel');

        $data = array(
            'name' => $_POST['name'],
            'contact_number' => $_POST['contact_number'],
            'email' => $_POST['email']
        );

        $this->UsersModel->update($id, $data);

        header('Location: ' . base_url() . 'crud');
        exit;
    }

    public function delete($id)
    {
        $this->call->model('UsersModel');

        $this->UsersModel->delete($id);

        header('Location: ' . base_url() . 'crud');
        exit;
    }
}