<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTokenRequest;
use App\Http\Services\TokenService;
use Illuminate\Http\Request;
use Exception;

class TokenController extends Controller
{
    public function __construct
    (private TokenService $tokenService)
    {}

    public function store(StoreTokenRequest $request)
    {
        try {
            $token = $this->tokenService->createToken($request->validated());

            return response()->json([
                'token' => $token
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'current access revoked'
        ], 200);
    }

    public function destroyAll(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'revoked all tokens from given user'
        ], 200);
    }
}
