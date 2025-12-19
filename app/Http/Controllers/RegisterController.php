<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Services\RegisterService;

class RegisterController extends Controller
{
    public function __construct(private RegisterService $registerService) {}

    public function __invoke(RegisterRequest $request)
    {
        $token = app($this->registerService::class)($request->validated());

        return response()->json([
            'token' => $token,
        ], 201);
    }
}
