<?php

namespace App\Http\Controllers\Financial;

use App\Application\UseCases\Financial\create\CreateFinancialEntry;

use App\Application\UseCases\Financial\create\CreateFinancialInput;
use App\Application\UseCases\Financial\create\CreateFinancialOutput;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialEntryController extends Controller
{
    public function store(Request $request, CreateFinancialEntry $useCase)
    {
        try {
            $entry = $useCase->execute(CreateFinancialInput::from($request));

            return response()->json([
                'id' => $entry->id
            ],201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

}
