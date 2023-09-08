<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    /**
    * @var ModelName
    */
    protected $model;

    public function __construct(User $model)
    {
		$this->model = $model;
    }

	/**
     * Get first user by email
     * 
     * @param string $email
	 * @return User|null
     */
	public function getFirstByEmail(string $email): ?User
	{
		return $this->model->where('email', $email)->first();
	}

	/**
     * Create new user with spesific data
	 * 
     * @param string $email
     * @param string $password
     * @param string $name
     * @param array|null $otherFields
	 * @return User
     */
	public function createNewUser(string $email, string $password, string $name, ?array $otherFields): User
	{
		$body = [
			'email' 	=> $email,
			'password'	=> $password,
			'name'		=> $name
		];

		if (!empty($otherFields)) {
			$data = array_merge($body, $otherFields);
		}
		$data = $body;

		return User::create($data);
	}
}