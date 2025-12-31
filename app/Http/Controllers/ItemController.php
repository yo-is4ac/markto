<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Resources\ItemResource;
use App\Http\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(private ItemService $itemService) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $item = $this->itemService->store($request->validated());

        return response()->json(new ItemResource($item), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = $this->itemService->show($id);

        return response(new ItemResource($item));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
