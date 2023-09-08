<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if (! $request->expectsJson()) {
            return abort(response()->json([
                'status' => [
                    'code'        => Response::HTTP_UNAUTHORIZED,
                    'description' => "You don't have access to make this request",
                ],
            ], Response::HTTP_UNAUTHORIZED));
        }
    }
}
