<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedLista extends Model
{
    protected $table = 'shared_lista';

    protected $fillable = [
        'lista_id',
        'code',
        'can_access',
    ];

    public function lista()
    {
        return $this->belongsTo(Lista::class);
    }
}
