<?php

namespace App\Http\Controllers\Monthly;

use App\Application\UseCases\Monthly\CloseMonthlyCashFlow;
use App\Application\UseCases\Monthly\CloseMonthlyCashFlowInput;
use App\Http\Controllers\Controller;
use App\Presenters\MonthlyClosingPresenter;
use Illuminate\Http\Request;

class MonthlyClosingController extends Controller implements MonthlyClosingAPI
{
    public function store(Request $request, CloseMonthlyCashFlow $useCase)
    {
        try {
            $closing = $useCase->execute(CloseMonthlyCashFlowInput::from($request));

            return response()->json(
                MonthlyClosingPresenter::toResponse($closing),
                201
                );

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

}
