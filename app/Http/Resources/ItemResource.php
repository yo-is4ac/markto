<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lista' => $this->lista->name,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
