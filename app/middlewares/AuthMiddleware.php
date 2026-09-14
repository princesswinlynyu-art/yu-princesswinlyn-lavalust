<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        $session = lava_instance()->session;

        if (!$session->has_userdata('logged_in') || $session->userdata('logged_in') !== true)
        {
            redirect('login');
        }

        return $next();
    }
}