<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AccountModel extends Model
{
    protected $table = 'accounts';

    public function getByUsername($username)
    {
        return $this->find_by('username', $username);
    }
}
