<?php

namespace App\Http\Controllers\Monthly;
use App\Application\UseCases\Monthly\CloseMonthlyCashFlow;
use Illuminate\Http\Request;
use OpenAPI\Attributes as OA;

interface MonthlyClosingAPI
{
    #[OA\Post(
        path: "/api/monthly-closing",
        summary: "Realizar fechamento mensal do fluxo de caixa",
        tags: ["Monthly Closing"]
    )]

    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: [
                "enterprise_id",
                "month",
                "year"
            ],

            properties: [

                new OA\Property(
                    property: "enterprise_id",
                    type: "integer",
                    example: 1
                ),

                new OA\Property(
                    property: "month",
                    type: "integer",
                    example: 5
                ),

                new OA\Property(
                    property: "year",
                    type: "integer",
                    example: 2026
                ),
            ]
        )
    )]

    #[OA\Response(
        response: 200,
        description: "Fechamento mensal realizado com sucesso",

        content: new OA\JsonContent(
            properties: [

                new OA\Property(
                    property: "enterprise_id",
                    type: "integer",
                    example: 1
                ),

                new OA\Property(
                    property: "month",
                    type: "integer",
                    example: 5
                ),

                new OA\Property(
                    property: "year",
                    type: "integer",
                    example: 2026
                ),

                new OA\Property(
                    property: "closed",
                    type: "boolean",
                    example: true
                ),
            ]
        )
    )]

    #[OA\Response(
        response: 400,
        description: "Erro ao realizar fechamento mensal"
    )]
    public function store(Request $request);
}
