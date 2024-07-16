<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CommonHelper;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Http\Services\QuotationService;
use App\Http\RequestHandlers\QuotationRequest;

class QuotationController extends Controller
{
    protected $quotationService;

    public function __construct(QuotationService $quotationService) {
        $this->quotationService = $quotationService;
    }

    public function getQuotationPage()
    {
        $currencyCodes = CommonHelper::getCurrencyCodes();
        return View::make('pages.quotation')->with('currencyCodes', $currencyCodes);
    }

    public function getQuotation(QuotationRequest $request)
    {
        $response = $this->quotationService->getQuotation($request->all());

        return response()->json(
            $response
        , $response['status']);
    }

}