<?php

namespace App\Repositories\User;

interface UserInterface
{
    /**
     * Get first user by email
     * 
     * @param string $email
     */
    public function getFirstByEmail(string $email);

    /**
     * Create new user with spesific data
     * @param string $email
     * @param string $password
     * @param string $name
     * @param array|null $otherFields
     */
    public function createNewUser(string $email, string $password, string $name, ?array $otherFields);
}