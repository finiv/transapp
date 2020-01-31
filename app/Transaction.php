<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'title',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notes()
    {
        return $this->morphToMany(Note::class);
    }

    public static function getTotalTransactionsValue ($id)
    {
        return Transaction::where('type', '=', '1')->where('user_id', $id)->sum('amount') - Transaction::where('type', '=', '0')->where('user_id', $id)->sum('amount');
    }

    public static function countTransactions ($id)
    {
        return Transaction::where('user_id', $id)->count('amount');
    }

    public function scopeOrderTransactions()
    {
        return Transaction::orderBy('id','DESC')->paginate(5);
    }
}
