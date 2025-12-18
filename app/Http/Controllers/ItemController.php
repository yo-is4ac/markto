<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Services\ItemService;

class ItemController extends Controller
{
    public function __construct
    (private ItemService $itemService){}

    public function store(StoreItemRequest $request)
    {
        $item = $this->itemService->store($request->validated());

        return response()->json([
            'id' => $item->id,
            'lista' => $item->lista->name,
            'name' => $item->name,
            'created_at' => $item->created_at
        ]);
    }
}
