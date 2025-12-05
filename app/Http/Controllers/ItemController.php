<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Services\ItemService;
use Exception;

class ItemController extends Controller
{
    public function __construct(
        private ItemService $itemService
    )
    {
    }

    public function store(StoreItemRequest $request)
    {
        try {
            $this->itemService->store($request->validated());

            return response()->json([
                'status' => 'ok',
                'message' => 'created'
            ]);

        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
