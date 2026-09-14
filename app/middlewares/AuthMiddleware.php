<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle()
    {
        if (!isset($_SESSION['logged_in']))
        {
            header('Location: ' . base_url() . 'login');
            exit;
        }
    }
}