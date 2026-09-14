<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AccountModel extends Model
{
    protected $table = 'accounts';

    public function getByUsername($username)
    {
        $accounts = $this->all();

        foreach ($accounts as $account)
        {
            if ($account['username'] == $username)
            {
                return $account;
            }
        }

        return null;
    }
}