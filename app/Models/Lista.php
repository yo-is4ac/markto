<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Lista extends Model
{
    protected $table = 'lista';

    protected $fillable = [
        'name'
    ];

    public function item() {
        $this->hasMany(Item::class);
    }
}
