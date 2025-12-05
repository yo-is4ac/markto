<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lista;

class Item extends Model
{
    protected $fillable = [
        'list_id',
        'name',
        'description',
        'quantity'
    ];

    public function list() {
        $this->belongsTo(Lista::class);
    }
}
