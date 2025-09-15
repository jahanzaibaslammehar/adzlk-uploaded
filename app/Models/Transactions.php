<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'poster_id',
        'ad_id',
        'amount',
        'payment_type',
        'payment_status',
    ];

    public function poster()
    {
        return $this->belongsTo(Poster::class);
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
