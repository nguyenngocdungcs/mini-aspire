<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
