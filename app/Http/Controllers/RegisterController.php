<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Services\RegisterService;
use Exception;

class RegisterController extends Controller
{
    public function __construct(
        private RegisterService $registerService
    ){}

    public function __invoke(RegisterRequest $request)
    {
        try {
            app($this->registerService::class)($request->validated());

            return response()->json([
                'status' => 'ok',
                'message' => 'created'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
