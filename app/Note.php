<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'entity_type',
        'entity_id'
    ];

    public function user()
    {
        return $this->morphedByMany(User::class);
    }

    public function transaction()
    {
        return $this->morphedByMany(Transaction::class);
    }
}
