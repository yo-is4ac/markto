<?php

namespace App\Http\Services;

use App\Http\Repositories\ItemRepository;
use Exception;

class ItemService {

    public function __construct(
        private ItemRepository $itemRepository
    )
    {}

    public function store(array $data)
    {
        try {
            $this->itemRepository->store(
                $data['lista_id'],
                $data['name'],
                $data['description'],
                $data['quantity']
            );
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
