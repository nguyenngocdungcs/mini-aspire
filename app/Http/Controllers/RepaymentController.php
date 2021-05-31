<?php

namespace App\Http\Controllers;

use App\Exceptions\ResponseException;
use App\Http\Responses\APIResponse;
use App\Repayment;
use App\Services\RepaymentService;
use DB, Log;

class RepaymentController extends Controller
{
    /**
     * Pay a repayment
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function pay($id)
    {
        try {
            DB::beginTransaction();

            $repayment = Repayment::with([
                'loan',
                'user' => function ($query) {
                    // To prevent Race Condition
                    $query->lockForUpdate();
                }])
                ->find($id);

            if ($repayment->is_paid) {
                throw new ResponseException("This repayment is paid");
            }

            if ($repayment->loan->is_paid) {
                throw new ResponseException("This loan is paid");
            }

            RepaymentService::pay($repayment);
            DB::commit();

            return APIResponse::success($repayment);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('RepaymentController|store|' . $e->getMessage());
            return APIResponse::error($e);
        }
    }

    public function show(Repayment $repayment) {
        return APIResponse::success($repayment);
    }
}
