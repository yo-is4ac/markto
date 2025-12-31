<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\ListaContract;
use App\Http\Resources\ListasResource;
use App\Models\Lista;
use Illuminate\Support\Facades\Auth;

class ListaRepository implements ListaContract
{
    public function __construct(private Lista $lista) {}

    public function index() {
        return Auth::user()->lista->map(function ($lista) {
            return new ListasResource($lista);
        });
    }

    public function store(string $name)
    {
        return $this->lista->create([
            'user_id' => Auth::user()->id,
            'name' => $name,
        ]);
    }

    public function show(string $id)
    {
        return Auth::user()->lista->where('id', '=', $id)->first();
    }
}
