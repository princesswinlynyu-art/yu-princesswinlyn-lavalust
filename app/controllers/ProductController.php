<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function index()
    {
        $this->call->model('ProductModel');

        $data['products'] = $this->ProductModel->all();

        $this->call->view('products_view', $data);
    }

    public function create()
    {
        $this->call->view('product_create');
    }

    public function store()
    {
        $this->call->model('ProductModel');

        $data = array(
            'product_name' => $_POST['product_name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        );

        $this->ProductModel->insert($data);

        header('Location: ' . base_url() . 'products');
        exit;
    }
}