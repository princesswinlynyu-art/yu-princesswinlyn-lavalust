<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle(Closure $next)
    {
        echo "
        <h2>Welcome BSIT 3F6 Students Only!</h2>
        <p>This page is protected by StudentMiddleware.</p>
        ";

        return $next();
    }
}