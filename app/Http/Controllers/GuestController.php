<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGuestListRequest;
use App\Http\Services\GuestService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __construct
    (
        private GuestService $guestService
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(UpdateGuestListRequest $request, string $code)
    {
        $sharedLista = $this->guestService->update(data: $request->validated(), code: $code);

        return response()->json([
            'lista' => $sharedLista->lista->name,
            'can_access' => json_decode($sharedLista->can_access, true)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
