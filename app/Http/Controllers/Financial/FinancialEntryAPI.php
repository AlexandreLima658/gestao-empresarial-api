<?php

namespace App\Http\Controllers\Financial;

use App\Application\UseCases\Financial\create\CreateFinancialEntry;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

interface FinancialEntryAPI
{
    #[OA\Post(
        path: "/api/financial-entries",
        summary: "Criar lançamento financeiro",
        tags: ["Financial Entry"]
    )]

    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: [
                "enterprise_id",
                "cost_center_id",
                "description",
                "amount",
                "type",
                "entry_date"
            ],
            properties: [

                new OA\Property(
                    property: "enterprise_id",
                    type: "integer",
                    example: 1
                ),

                new OA\Property(
                    property: "cost_center_id",
                    type: "integer",
                    example: 1
                ),

                new OA\Property(
                    property: "description",
                    type: "string",
                    example: "Pagamento aluguel"
                ),

                new OA\Property(
                    property: "amount",
                    type: "number",
                    format: "float",
                    example: 3500
                ),

                new OA\Property(
                    property: "type",
                    type: "string",
                    example: "EXPENSE"
                ),

                new OA\Property(
                    property: "entry_date",
                    type: "string",
                    format: "date",
                    example: "2026-05-11"
                ),
            ]
        )
    )]

    #[OA\Response(
        response: 201,
        description: "Lançamento criado"
    )]

    #[OA\Response(
        response: 400,
        description: "Erro ao criar lançamento"
    )]
    public function store(Request $request, CreateFinancialEntry $useCase);
}
