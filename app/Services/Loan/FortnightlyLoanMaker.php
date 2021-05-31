<?php
/**
 * Created by Andy Nguyen on 5/30/21
 * Copyright © 2018-2019 Beeknights Co., Ltd. All rights reserved.
 */

namespace App\Services\Loan;


use App\Loan;

class FortnightlyLoanMaker extends LoanMaker
{
    protected function getInterestRate($interestRate) {
        return $interestRate / (52 / 2);
    }

    protected function getRepaymentDates($loanTime, $repaymentTimes)
    {
        $result = [];
        for ($index = 1; $index <= $repaymentTimes; $index++) {
            $result[] = $loanTime->clone()->addWeek(2 * $index);
        }
        return $result;
    }

    protected function getFrequency()
    {
        return Loan::REPAYMENT_FREQUENCY_FORTNIGHTLY;
    }
}