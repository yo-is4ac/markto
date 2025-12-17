<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Services\ItemService;
use Exception;

class ItemController extends Controller
{
    public function __construct
    (private ItemService $itemService){}

    public function store(StoreItemRequest $request)
    {
        $this->itemService->store($request->validated());

        return response()->noContent(201);
    }
}
