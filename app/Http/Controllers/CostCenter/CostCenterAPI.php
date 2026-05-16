<?php

namespace App\Http\Controllers\CostCenter;

use App\Application\UseCases\CostCenter\create\CreateCostCenterUseCase;
use App\Application\UseCases\CostCenter\delete\DeleteCostCenter;
use App\Application\UseCases\CostCenter\retrieve\RetrieveCostCenterByEnterprise;
use App\Application\UseCases\CostCenter\update\UpdateCostCenter;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

interface CostCenterAPI
{
    #[OA\Post(
        path: "/api/cost-centers",
        summary: "Criar centro de custo",
        tags: ["Cost Center"]
    )]

    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ["enteprise_id","name"],
            properties: [

                new OA\Property(
                    property: "enterprise_id",
                    type: "integer",
                    example: 1
                ),

                new OA\Property(
                    property: "name",
                    type: "string",
                    example: "Centro de custo XPTO"
                )
            ]
        )
    )]
    #[OA\Response(
        response: 201,
        description: "Centro de custo criado"
    )]

    #[OA\Response(
        response: 400,
        description: "Erro ao criar um centro de custo"
    )]
    public function store(Request $request, CreateCostCenterUseCase $createCostCenter);
    #[OA\Get(
        path: "/api/enterprise/{enterpriseId}/cost-centers",
        summary: "Listar centros de custo por empresa",
        tags: ["Cost Center"]
    )]

    #[OA\Parameter(
        name: "enterpriseId",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer")
    )]
    #[OA\Response(
        response: 200,
        description: "Centro de custo encontrad"
    )]

    #[OA\Response(
        response: 404,
        description: "Centro de custo não encontrado"
    )]
    public function indexByEnterprise(int $enterpriseId, RetrieveCostCenterByEnterprise $useCase);

    #[OA\Put(
        path: "/api/cost-centers/{id}",
        summary: "Atualizar centro de custo",
        tags: ["Cost Center"]
    )]

    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ["name"],
            properties: [
                new OA\Property(
                    property: "name",
                    type: "string",
                    example: "Centro de custo Atualizado"
                )
            ]
        )
    )]

    #[OA\Response(
        response: 200,
        description: "Centro de custo atualizado"
    )]

    #[OA\Response(
        response: 404,
        description: "Centro de custo não encontrado"
    )]
    public function update(int $id, Request $request, UpdateCostCenter $updateCostCenter);
    #[OA\Delete(
        path: "/api/cost-centers/{id}",
        summary: "Remover centro de custo",
        tags: ["Cost Center"]
    )]

    #[OA\Parameter(
        name: "id",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer")
    )]
    #[OA\Response(
        response: 200,
        description: "Cento de custo removido"
    )]

    #[OA\Response(
        response: 404,
        description: "Centro de custo não encontrado"
    )]
    public function destroy(int $id, DeleteCostCenter $delete);

}
