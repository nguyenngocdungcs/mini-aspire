<?php
/**
 * Created by Andy Nguyen on 5/29/21
 * Copyright © 2018-2019 Beeknights Co., Ltd. All rights reserved.
 */

namespace App\Services;

use App\Exceptions\ResponseException;
use App\Repayment;

class RepaymentService
{
    public static function pay($repayment)
    {
        // Check if user paid the previous repayment
        if (Repayment::whereLoanId($repayment->loan_id)
            ->where('date', '<', $repayment->date)
            ->whereIsPaid(false)
            ->exists()) {
            throw new ResponseException('You need to pay the previous repayment');
        }

        $repayment->is_paid = true;
        $repayment->save();

        $repayment->loan->paid_amount += $repayment->amount;
        $repayment->loan->save();

        // Update user's credit point
        PointService::updatePointsAfterRepayment($repayment);

        return $repayment;
    }
}