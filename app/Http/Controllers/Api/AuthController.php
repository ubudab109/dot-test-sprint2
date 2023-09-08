<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private $services;

    /**
     * AuthController Constructor
     * 
     * @return void
     */
    public function __construct(AuthServices $services)
    {
        $this->services = $services;
    }

    /**
     * Login Request
     * 
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $input = $request->only('email', 'password');
        $login = $this->services->login($input['email'], $input['password']);
        return response()->json($login, $login['status']['code']);
    }
}
