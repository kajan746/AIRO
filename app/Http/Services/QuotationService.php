<?php

namespace App\Http\Services;

use App\Models\Quotation;
use App\Http\Helpers\CommonHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuotationService
{
    public function getQuotation($data)
    {
        try {
            $ages = explode(',', $data['age']);
            $duration = CommonHelper::getDateTimeDifferenceFormat($data['start_date'], $data['end_date'], '%a');
            $totalLoad = 0;
            foreach ($ages as $key => $age) {
                $totalLoad += config('common.fixed_quotation_rate') * CommonHelper::getLoadForAge((int)$age) * $duration;
            }
            $totalLoad = round($totalLoad);
            $quotation = null;
            DB::transaction(function () use (&$quotation, $totalLoad, $data) {
                $quotation = new Quotation;
                $quotation->quotation_code = CommonHelper::generateRandomCode();
                $quotation->age = $data['age'];
                $quotation->user_id = Auth::guard('api')->user()->id;
                $quotation->currency_id = $data['currency_id'];
                $quotation->start_date = CommonHelper::getDateTimeFormat($data['start_date'], 'Y-m-d');
                $quotation->end_date = CommonHelper::getDateTimeFormat($data['end_date'], 'Y-m-d');
                $quotation->amount = $totalLoad;
                $quotation->save();
            });
            $quotation = ['total' => number_format($totalLoad, 2), 'currency_id' => CommonHelper::getCurrencyCodes()[$quotation->currency_id], 'quotation_id' => $quotation->quotation_code];
            return ['message' => 'Retrieved the quotation', 'status' => 200, 'data' => $quotation];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ['message' => 'Could not get the quotation.', 'status' => 500];
        }
    }
}
