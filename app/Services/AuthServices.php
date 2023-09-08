<?php

namespace App\Services;

use App\Repositories\Auth\AuthInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthServices implements AuthInterface
{
    private $userInterface;

    /**
     * AuthServices Constructor
     * 
     * @return void
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Login user using email and password
     * 
     * @param string $email
     * @param string $password
     * @return array
     */
    public function login(string $email, $password): array
    {
        $user = $this->userInterface->getFirstByEmail($email);
        if (!$user) {
            return [
                'status' => [
                    'code'    => Response::HTTP_UNAUTHORIZED,
                    'description' => 'Email not found',
                ],
                'results' => null,
            ];
        }

        if (Hash::check($password, $user->password)) {
            $token = $user->createToken('user_token')->plainTextToken;
            return [
                'status' => [
                    'code'    => Response::HTTP_OK,
                    'description' => 'Logged in successfully',
                ],
                'results' => [
                    'token' => $token,
                ],
            ];
        }

        return [
            'status' => [
                'code'    => Response::HTTP_UNAUTHORIZED,
                'description' => 'Invalid Credentials',
            ],
            'results' => null,
        ];

    }
}