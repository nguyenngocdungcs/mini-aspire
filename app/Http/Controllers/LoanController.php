<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanCreateRequest;
use App\Http\Responses\APIResponse;
use App\Loan;
use App\Services\Loan\LoanMaker;
use DB, Log;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Loan::query();
        $this->queryFilter($query, ['user_id', 'repayment_frequency']);
        $items = $query->paginate();
        return APIResponse::success($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LoanCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $maker = LoanMaker::getMaker($request->repayment_frequency);
            $maker
                ->setArrangementFee($request->arrangement_fee)
                ->make(
                    $request->user_id,
                    $request->amount,
                    $request->interest_rate,
                    $request->repayment_times
                )
                ->save();

            DB::commit();

            $loan = $maker->getLoan();
            return APIResponse::success($loan);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('LoanController|store' . $e->getMessage());
            return APIResponse::error($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        $loan->load('repayments');
        return APIResponse::success($loan);
    }

    public function nextRepayment(Loan $loan)
    {
        $repayment = $loan->repayments()->where('is_paid', false)->oldest('date')->first();
        return APIResponse::success($repayment);
    }
}
