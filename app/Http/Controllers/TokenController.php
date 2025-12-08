<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTokenRequest;
use App\Http\Services\TokenService;
use Exception;

class TokenController extends Controller
{

    public function __construct
    (private TokenService $tokenService)
    {}

    public function store(StoreTokenRequest $request)
    {
        try {
            $token = $this->tokenService->store($request->validated());

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
}
