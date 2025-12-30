<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $table = 'lista';

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sharedLista() {
        return $this->hasOne(SharedLista::class);
    }

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
