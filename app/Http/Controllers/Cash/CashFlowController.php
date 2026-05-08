<?php

namespace App\Http\Controllers\Cash;

use App\Application\UseCases\Cash\CashFlow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    public function index(Request $request, CashFlow $useCase)
    {
        try {
            $cashFlow = $useCase->execute(
                $request->input('enterprise_id'),
                $request->input('start_date'),
                $request->input('end_date'),
            );

            return response()->json($cashFlow);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

}
