<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\ListaContract;
use App\Models\Lista;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Exception;

class ListaRepository implements ListaContract {
    public function __construct
    (private Lista $lista){}

    public function store(string $name) {
        try {
            $user = Auth::user();

            $code = (string) Str::uuid();

            $this->lista->create([
                'user_id' => $user->id,
                'name' => $name,
                'code' => substr($code, 0, 8)
            ]);
        } catch(Exception $e) {
            throw new Exception(message: $e->getMessage(), code: 500);
        }
    }
}
