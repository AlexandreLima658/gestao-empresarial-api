<?php

namespace App\Http\Controllers\Financial;

use App\Application\UseCases\Financial\create\CreateFinancialEntry;

use App\Application\UseCases\Financial\create\CreateFinancialInput;
use App\Application\UseCases\Financial\create\CreateFinancialOutput;
use App\Http\Controllers\Controller;
use App\Presenters\FinancialEntryPresenter;
use Illuminate\Http\Request;

class FinancialEntryController extends Controller implements FinancialEntryAPI
{
    public function store(Request $request, CreateFinancialEntry $useCase)
    {
        try {
            $entry = $useCase->execute(CreateFinancialInput::from($request));

            return response()->json(
                FinancialEntryPresenter::toResponse($entry),
                201
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

}
