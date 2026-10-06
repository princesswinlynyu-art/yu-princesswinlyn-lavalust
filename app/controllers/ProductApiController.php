<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('ProductModel');
        $this->call->model('AccountModel');
    }

    public function demo()
    {
        $this->call->view('api_demo');
    }

    public function login()
    {
        $this->api->require_method('POST');
        $this->api->rate_limit('login');

        $input = $this->api->body();
        $username = strtolower(trim((string) ($input['username'] ?? '')));
        $password = (string) ($input['password'] ?? '');

        $user = $this->AccountModel->getByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            $this->api->respond_error('Invalid username or password', 401);
        }

        $token = $this->api->encode_jwt([
            'sub' => (string) $user['id'],
            'username' => $user['username'],
        ]);

        $this->api->respond([
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id' => (int) $user['id'],
                'username' => $user['username'],
            ],
        ], 200);
    }

    public function register()
    {
        $this->api->require_method('POST');
        $this->api->rate_limit('register');
        $input = $this->api->body();
        $fullname = trim((string) ($input['fullname'] ?? ''));
        $username = strtolower(trim((string) ($input['username'] ?? '')));
        $password = (string) ($input['password'] ?? '');

        if ($fullname === '' || !preg_match('/^[a-z0-9_.-]{3,50}$/', $username) || strlen($password) < 8) {
            $this->api->respond_error('Enter a name, a username of 3–50 letters or digits, and a password of at least 8 characters.', 400);
        }
        if ($this->AccountModel->getByUsername($username)) {
            $this->api->respond_error('That username is already registered.', 409);
        }

        $this->AccountModel->insert([
            'fullname' => $fullname,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        $this->api->respond(['message' => 'Account created. You can now log in.'], 201);
    }

    public function index()
    {
        $this->api->require_method('GET');
        $this->api->require_jwt();

        $products = $this->ProductModel->all() ?: [];
        $this->api->respond(['data' => $products], 200);
    }

    public function show($id)
    {
        $this->api->require_method('GET');
        $this->api->require_jwt();

        $product = $this->ProductModel->find((int) $id);

        if (!$product) {
            $this->api->respond_error('Product not found', 404);
        }

        $this->api->respond(['data' => $product], 200);
    }

    public function store()
    {
        $this->api->require_method('POST');
        $this->api->require_jwt();

        $input = $this->api->body();
        $product_name = trim((string) ($input['product_name'] ?? ''));
        $description = trim((string) ($input['description'] ?? ''));
        $price = filter_var($input['price'] ?? null, FILTER_VALIDATE_FLOAT);
        $quantity = filter_var($input['quantity'] ?? null, FILTER_VALIDATE_INT);

        if ($product_name === '' || strlen($product_name) > 100 || $price === false || $price < 0 || $quantity === false || $quantity < 0) {
            $this->api->respond_error('Use a product name up to 100 characters, a non-negative price, and a non-negative whole quantity.', 400);
        }

        $product_id = $this->ProductModel->insert([
            'product_name' => $product_name,
            'description' => $description,
            'price' => $price,
            'quantity' => $quantity,
        ]);

        $product = $this->ProductModel->find((int) $product_id);

        $this->api->respond([
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }

    public function update($id)
    {
        $this->api->require_method('PUT');
        $this->api->require_jwt();

        $input = $this->api->body();
        $existing = $this->ProductModel->find((int) $id);

        if (!$existing) {
            $this->api->respond_error('Product not found', 404);
        }

        $data = [
            'product_name' => trim((string) ($input['product_name'] ?? $existing['product_name'])),
            'description' => trim((string) ($input['description'] ?? $existing['description'])),
            'price' => (string) ($input['price'] ?? $existing['price']),
            'quantity' => (int) ($input['quantity'] ?? $existing['quantity']),
        ];

        if ($data['product_name'] === '' || strlen($data['product_name']) > 100 || !is_numeric($data['price']) || (float) $data['price'] < 0 || $data['quantity'] < 0) {
            $this->api->respond_error('Use a product name up to 100 characters, a non-negative price, and a non-negative whole quantity.', 400);
        }

        $this->ProductModel->update((int) $id, $data);
        $updated = $this->ProductModel->find((int) $id);

        $this->api->respond([
            'message' => 'Product updated successfully',
            'data' => $updated,
        ], 200);
    }

    public function patch($id)
    {
        $this->api->require_method('PATCH');
        $this->api->require_jwt();

        $input = $this->api->body();
        $existing = $this->ProductModel->find((int) $id);

        if (!$existing) {
            $this->api->respond_error('Product not found', 404);
        }

        $data = [];
        foreach (['product_name', 'description', 'price', 'quantity'] as $field) {
            if (array_key_exists($field, $input)) {
                $data[$field] = $input[$field];
            }
        }

        if (empty($data)) {
            $this->api->respond_error('No changes supplied.', 400);
        }

        if (isset($data['product_name'])) {
            $data['product_name'] = trim((string) $data['product_name']);
            if ($data['product_name'] === '') {
                $this->api->respond_error('Product name cannot be empty.', 400);
            }
        }

        if (isset($data['quantity'])) {
            $quantity = filter_var($data['quantity'], FILTER_VALIDATE_INT);
            if ($quantity === false || $quantity < 0) {
                $this->api->respond_error('Quantity must be a non-negative whole number.', 400);
            }
            $data['quantity'] = $quantity;
        }
        if (isset($data['product_name']) && strlen($data['product_name']) > 100) {
            $this->api->respond_error('Product name must be 100 characters or fewer.', 400);
        }
        if (isset($data['price']) && (!is_numeric($data['price']) || (float) $data['price'] < 0)) {
            $this->api->respond_error('Price must be a non-negative number.', 400);
        }

        $this->ProductModel->update((int) $id, $data);
        $updated = $this->ProductModel->find((int) $id);

        $this->api->respond([
            'message' => 'Product updated successfully',
            'data' => $updated,
        ], 200);
    }

    public function delete($id)
    {
        $this->api->require_method('DELETE');
        $this->api->require_jwt();

        $product = $this->ProductModel->find((int) $id);

        if (!$product) {
            $this->api->respond_error('Product not found', 404);
        }

        $this->ProductModel->delete((int) $id);
        $this->api->respond([
            'message' => 'Product deleted successfully',
            'deleted_id' => (int) $id,
        ], 200);
    }
}
