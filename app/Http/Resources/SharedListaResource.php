<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SharedListaResource extends JsonResource
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
            'lista_id' => $this->lista_id,
            'code' => $this->code,
            'can_access' => $this->can_access,
            'created_at' => $this->created_at
        ];
    }
}
