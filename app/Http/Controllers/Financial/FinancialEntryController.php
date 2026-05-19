<?php

namespace App\Http\Controllers\Financial;

use App\Application\UseCases\Financial\create\CreateFinancialEntry;
use App\Application\UseCases\Financial\create\CreateFinancialInput;
use App\Http\Controllers\Controller;
use App\Presenters\FinancialEntryPresenter;
use Illuminate\Http\Request;

class FinancialEntryController extends Controller implements FinancialEntryAPI
{

    public function __construct(
        private CreateFinancialEntry $useCase
    )
    {}

    public function store(Request $request)
    {
        try {
            $entry = $this->useCase->execute(
                CreateFinancialInput::from($request)
            );

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
