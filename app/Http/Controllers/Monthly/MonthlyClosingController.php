<?php

namespace App\Http\Controllers\Monthly;

use App\Application\UseCases\Monthly\CloseMonthlyCashFlow;
use App\Application\UseCases\Monthly\CloseMonthlyCashFlowInput;
use App\Application\UseCases\Monthly\CloseMonthlyCashFlowOutput;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonthlyClosingController extends Controller implements MonthlyClosingAPI
{
    public function store(Request $request, CloseMonthlyCashFlow $useCase)
    {
        try {
            $closing = $useCase->execute(CloseMonthlyCashFlowInput::from($request));

            return response()->json([
                'enterprise_id' => $closing->enterpriseId,
                'month' => $closing->month,
                'year' => $closing->year,
                'closed' => true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

}
