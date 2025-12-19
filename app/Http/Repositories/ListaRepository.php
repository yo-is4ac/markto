<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\ListaContract;
use App\Models\Lista;
use Illuminate\Support\Facades\Auth;

class ListaRepository implements ListaContract
{
    public function __construct(private Lista $lista) {}

    public function store(string $name)
    {
        $user = Auth::user();

        return $this->lista->create([
            'user_id' => $user->id,
            'name' => $name,
        ]);
    }
}
