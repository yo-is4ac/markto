<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\SharedListaContract;
use App\Models\SharedLista;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SharedListaRepository implements SharedListaContract
{
    public function __construct(
        private SharedLista $sharedLista,
    ) {}

    public function index() {
      //  $userSharedListas = Auth::user()->lista->filter(function ($lista) {
       //     return $lista->sharedLista !== null;
       // })->map(function ($lista) {
        //    return $lista->sharedLista;
       // });

        $listas = $this->sharedLista->all();

        $sharedListas = $listas
            ->map(function ($lista) {
                foreach($lista->can_access as $guest) {
                    if ($guest->email === Auth::user()->email) {
                        return $lista;
                    }
                }
            });

        return $sharedListas;
    }

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
            'can_access' => json_encode($data),
        ]);
    }

    public function guestExists(array $guestList, string $email)
    {
        foreach ($guestList as $index => $guest) {
            if ($guest['email'] === $email) {
                return true;
            }
        }
    }
}
