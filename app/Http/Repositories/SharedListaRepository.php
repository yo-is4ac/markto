<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\SharedListaContract;
use App\Models\SharedLista;
use Illuminate\Support\Str;

class SharedListaRepository implements SharedListaContract {
    public function __construct
    (private SharedLista $sharedLista){}

    public function store(string $listaId)
    {
        return $this->sharedLista->create([
            'lista_id' => $listaId,
            'code' => substr(Str::uuid(), 0, 8),
        ]);
    }

    public function getByCode(string $code)
    {
        return SharedLista::where('code', '=', $code)->first();
    }

    public function updateGuest(SharedLista $sharedLista, array $data)
    {
        $sharedLista->update([
            'can_access' => json_encode($data)
        ]);
    }

    public function guestExists(array $guestList, string $email)
    {
        foreach($guestList as $guest) {
            if ($guest['email'] === $email) {
                return true;
            }
        }
    }
}
