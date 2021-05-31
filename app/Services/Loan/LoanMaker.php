<?php
/**
 * Created by Andy Nguyen on 5/30/21
 * Copyright © 2018-2019 Beeknights Co., Ltd. All rights reserved.
 */

namespace App\Services\Loan;


use App\Loan;
use App\Repayment;

abstract class LoanMaker
{
    abstract protected function getRepaymentDates($loanTime, $repaymentTimes);
    abstract protected function getInterestRate($interestRate);
    abstract protected function getFrequency();

    public static function getMaker($repaymentFrequency) {
        if ($repaymentFrequency == Loan::REPAYMENT_FREQUENCY_MONTHLY) {
            return new MonthlyLoanMaker();
        }
        if ($repaymentFrequency == Loan::REPAYMENT_FREQUENCY_WEEKLY) {
            return new WeeklyLoanMaker();
        }
        if ($repaymentFrequency == Loan::REPAYMENT_FREQUENCY_FORTNIGHTLY) {
            return new FortnightlyLoanMaker();
        }

        throw new \Exception("Maker not found");
    }

    public $loan;
    public $repayments = [];
    public $arrangementFee = 0;

    public function getRepayments()
    {
        return $this->repayments;
    }

    public function getLoan()
    {
        return $this->loan;
    }

    public function setArrangementFee($arrangementFee)
    {
        $this->arrangementFee = $arrangementFee;
        return $this;
    }

    public function make($userId, $amount, $interestRate, $repaymentTimes)
    {
        $loanTime = now();
        $total = 0;
        $principalEachTime = $amount / $repaymentTimes;
        $remain = $amount;
        $repaymentDates = $this->getRepaymentDates($loanTime, $repaymentTimes);
        foreach ($repaymentDates as $date) {
            $interest = $this->getInterestRate($interestRate) * $remain;
            $repaymentAmount = $interest + $principalEachTime;
            $remain -= $principalEachTime;
            $total += $repaymentAmount;

            // Create repayment
            $repayment = new Repayment();
            $repayment->fill([
                'user_id' => $userId,
                'date' => $date,
                'amount' => round($repaymentAmount, 2),
            ]);
            $this->repayments[] = $repayment;
        }

        $this->loan = new Loan();
        $this->loan->fill([
            'user_id' => $userId,
            'amount' => $amount,
            'interest_rate' => $interestRate,
            'arrangement_fee' => $this->arrangementFee,
            'repayment_frequency' => $this->getFrequency(),
            'repayment_times' => $repaymentTimes,
            'total_amount' => round($total + $this->arrangementFee, 2)
        ]);
        return $this;
    }

    public function save()
    {
        $this->loan->save();
        foreach ($this->repayments as $repayment) {
            $repayment->loan_id = $this->loan->id;
            $repayment->save();
        }
    }
}