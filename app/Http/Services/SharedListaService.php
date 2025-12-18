<?php

namespace App\Http\Services;

use App\Http\Repositories\SharedListaRepository;

class SharedListaService {
    public function __construct
    (private SharedListaRepository $sharedListaRepository){}

    public function store(array $data) {
        return $this->sharedListaRepository->store(listaId: $data['lista_id']);
    }

    public function update(array $data) {
        $sharedLista = $this->sharedListaRepository->getByCode(code: $data['code']);

        if (empty($sharedLista->can_access)) {
            $this->sharedListaRepository->update(sharedLista: $sharedLista, email: $data['email']);
        } else {
            $newlyGuests = $this->pushGuest(json_decode($sharedLista->can_access), $data['email']);

            $sharedLista->update([
                'can_access' => json_encode($guests)
            ]);
        }
    }

    private function pushGuest(array $guests, $email) {
        array_push([
            'time' => now(),
            'guest' => $email
        ], $guests);

        return $guests;
    }
}
