<?php

namespace App\Repositories\Auth;

interface AuthInterface
{
    /**
     * Login interfaces 
     * @param string $email
     * @param string $password
     */
    public function login(string $email, string $password);
}