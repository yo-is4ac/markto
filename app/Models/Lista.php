<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Lista extends Model
{
    protected $table = 'lista';

    protected $fillable = [
        'user_id',
        'name',
        'code'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function item() {
        $this->hasMany(Item::class);
    }
}
