<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthTokenRequest;
use App\Http\Services\TokenService;
use App\Http\Requests\ResetTokenRequest;
use Exception;

class TokenController extends Controller
{

    public function __construct
    (private TokenService $tokenService)
    {}

    public function auth(AuthTokenRequest $request)
    {
        try {
            $token = $this->tokenService->attemptToAuth($request->validated());

            return response()->json([
                'status' => 'logged',
                'token' => $token
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function reset(ResetTokenRequest $request) {
        $token = $this->tokenService->resetToken($request->validated());

        return response()->json([
                'status' => 'logged',
                'token' => $token
        ], 200);
    }
}
