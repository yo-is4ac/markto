<?php

namespace App\Http\Services;

use App\Http\Repositories\ItemRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class ItemService
{
    public function __construct(private ItemRepository $itemRepository) {}

    public function store(array $data)
    {
        return $this->itemRepository->store(
            $data['lista_id'],
            $data['name'],
            $data['description'],
            $data['quantity']
        );
    }

    public function show(string $id) {
        $item = $this->itemRepository->show($id);

        if (empty($item)) throw new Exception('Not Found');

        $ownerId = $item->lista->user_id;

        if (Auth::user()->id !== $ownerId) {
            throw new Exception('You have no permission to perform this action');
        }

        return $item;
    }
}
