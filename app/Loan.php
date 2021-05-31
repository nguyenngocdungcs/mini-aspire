<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    const REPAYMENT_FREQUENCY_MONTHLY     = 1;
    const REPAYMENT_FREQUENCY_FORTNIGHTLY = 2;
    const REPAYMENT_FREQUENCY_WEEKLY      = 3;

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float',
        'interest_rate' => 'float',
        'arrangement_fee' => 'float',
        'repayment_times' => 'float',
        'total_amount' => 'float',
        'paid_amount' => 'float',
    ];

    protected $appends = ['is_paid', 'remain_amount'];

    public function repayments()
    {
        return $this->hasMany(Repayment::class)->orderBy('date');
    }

    public function getIsPaidAttribute()
    {
        return $this->paid_amount >= $this->total_amount;
    }

    public function getRemainAmountAttribute()
    {
        return round($this->total_amount - $this->paid_amount, 2);
    }
}
