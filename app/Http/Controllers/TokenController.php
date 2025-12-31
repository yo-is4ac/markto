<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTokenRequest;
use App\Http\Services\TokenService;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function __construct(private TokenService $tokenService) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTokenRequest $request)
    {
        $token = $this->tokenService->createToken($request->validated());

        return response()->json([
            'token' => $token
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'current access revoked']);
    }

    /**
     * Fully remove the resource from storage.
     */
    public function destroyAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'tokens deleted']);
    }
}
