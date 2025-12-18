<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTokenRequest;
use App\Http\Services\TokenService;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function __construct
    (private TokenService $tokenService){}

    public function store(StoreTokenRequest $request)
    {
        $token = $this->tokenService->createToken($request->validated());

        return response()->json([
            'token' => $token
        ]);
    }

    public function destroy(Request $request) {
        $request->user()->currentAccessToken()->delete();
    }

    public function destroyAll(Request $request) {
        $request->user()->tokens()->delete();
    }
}
