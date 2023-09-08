<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Test login request.
     */
    public function test_auth_login(): void
    {
        $user = User::create(['email' => 'test@test.com', 'name' => 'test', 'password' => Hash::make('123456')]);
        $response = $this->post('/api/login', ['email' => $user->email, 'password' => '123456']);
        User::find($user->id)->delete();

        $response->assertJsonStructure([
            'status' => [
                'code',
                'description',
            ],
            'results' => [
                'token'
            ],
        ]);
    }

    /**
     * Test request protected api with no authorization
     * Should return unauthorized json
     */
    public function test_should_return_unauthorized_when_no_token(): void
    {
        $response = $this->get('api/search/cities?');
        $response->assertJson([
            'status' => [
                'code'        => Response::HTTP_UNAUTHORIZED,
                'description' => "You don't have access to make this request"
            ]
        ]);
    }

    /**
     * Should return bad request when no form was sent to login API
     */
    public function test_should_return_bad_request_when_invalid_request(): void
    {
        $response = $this->post('/api/login');
        $response->assertJson([
            'status' => [
                'code'         => Response::HTTP_BAD_REQUEST,
                'description'  => 'Invalid Request',
                'errors'       => [
                    'email'    => ['Email is required'],
                    'password' => ['Password is required'],
                ]
            ]
        ]);
    }
}
