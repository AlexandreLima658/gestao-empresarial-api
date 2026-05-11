<?php

namespace App\Http\Controllers\Cash;
use App\Application\UseCases\Cash\CashFlow;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
interface CashFlowAPI
{
    #[OA\Get(
        path: "/api/cash-flow",
        summary: "Consultar fluxo de caixa",
        tags: ["Cash Flow"]
    )]

    #[OA\Parameter(
        name: "enterprise_id",
        description: "ID da empresa",
        in: "query",
        required: true,
        schema: new OA\Schema(
            type: "integer"
        )
    )]

    #[OA\Parameter(
        name: "start_date",
        description: "Data inicial",
        in: "query",
        required: true,
        schema: new OA\Schema(
            type: "string",
            format: "date",
            example: "2026-05-01"
        )
    )]

    #[OA\Parameter(
        name: "end_date",
        description: "Data final",
        in: "query",
        required: true,
        schema: new OA\Schema(
            type: "string",
            format: "date",
            example: "2026-05-31"
        )
    )]

    #[OA\Response(
        response: 200,
        description: "Fluxo de caixa consolidado",

        content: new OA\JsonContent(
            properties: [

                new OA\Property(
                    property: "total_income",
                    type: "number",
                    format: "float",
                    example: 12000
                ),

                new OA\Property(
                    property: "total_expense",
                    type: "number",
                    format: "float",
                    example: 4500
                ),

                new OA\Property(
                    property: "balance",
                    type: "number",
                    format: "float",
                    example: 7500
                )
            ]
        )
    )]

    #[OA\Response(
        response: 400,
        description: "Erro na consulta"
    )]
    public function index(Request $request, CashFlow $useCase);
}
