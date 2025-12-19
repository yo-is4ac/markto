<?php

namespace App\Http\Services;

use App\Http\Repositories\SharedListaRepository;
use Exception;

class GuestService
{
    public function __construct(private SharedListaRepository $sharedListaRepository) {}

    public function update(array $data, string $code)
    {
        $sharedLista = $this->sharedListaRepository->getByCode($code);

        $guestList = json_decode($sharedLista->can_access, true);

        if ($this->sharedListaRepository->guestExists($guestList, $data['email'])) {
            throw new Exception(message: "User already included in guest's list");
        }

        $newGuest = ['email' => $data['email'], 'created_at' => now()];

        array_push($guestList, $newGuest);

        $this->sharedListaRepository->updateGuest(sharedLista: $sharedLista, data: $guestList);

        return $sharedLista;
    }
}
