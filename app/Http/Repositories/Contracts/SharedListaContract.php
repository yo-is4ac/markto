<?php

namespace App\Http\Repositories\Contracts;

use App\Models\SharedLista;

interface SharedListaContract
{
    public function index();

    public function store(string $listaId);

    public function getByCode(string $code);

    public function updateGuest(SharedLista $sharedLista, array $data);

    public function guestExists(array $guestList, string $email);
}
