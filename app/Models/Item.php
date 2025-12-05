<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lista;

class Item extends Model
{
    protected $table = 'item';

    protected $fillable = [
        'lista_id',
        'name',
        'description',
        'quantity'
    ];

    public function list() {
        $this->belongsTo(Lista::class);
    }
}
