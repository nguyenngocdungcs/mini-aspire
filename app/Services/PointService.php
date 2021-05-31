<?php
/**
 * Created by Andy Nguyen on 5/29/21
 * Copyright © 2018-2019 Beeknights Co., Ltd. All rights reserved.
 */

namespace App\Services;


class PointService
{
    public static function updatePointsAfterRepayment($repayment)
    {
        // If user pay earlier or on time, +1 point, else -1
        $now = now()->toDateString();
        $repaymentDate = $repayment->date;
        if ($now <= $repaymentDate) {
            $repayment->user->credit_point += 1;
        } else {
            $repayment->user->credit_point -= 1;
        }

        $repayment->user->save();
    }
}