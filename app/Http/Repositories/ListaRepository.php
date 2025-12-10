<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\ListaContract;
use App\Models\Lista;

use Exception;
use Illuminate\Support\Facades\Auth;

class ListaRepository implements ListaContract {
    public function __construct(
        private Lista $lista
    )
    {}

    public function store(string $name) {
        try {
            $user = Auth::user();

            $this->lista->create([
                'user_id' => $user->id,
                'name' => $name
            ]);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
