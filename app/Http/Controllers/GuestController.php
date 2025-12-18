<?php

namespace App\Http\Controllers;

use App\Models\SharedLista;
use Illuminate\Http\Request;

class GuestController extends Controller
{
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
        $sharedLista = SharedLista::where('code', '=', $request->input('code'))->first();

        if (empty($sharedLista->can_access)) {
            $sharedLista->update([
                'can_access' => json_encode([[
                    'time' => now(),
                    'email' => $request->input('email')
                ]])
            ]);

            return response()->noContent(201);
        }

        $guests = json_decode($sharedLista->can_access);
        $guests[count($guests)] = [
            'time' => now(),
            'guest' => $request->input('email')
        ];

        $sharedLista->update([
            'can_access' => json_encode($guests)
        ]);
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
