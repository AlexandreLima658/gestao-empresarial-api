<?php

namespace App\Http\Controllers\Enterprise;
use App\Application\UseCases\Enterprise\Delete\DeleteEnterprise;
use App\Application\UseCases\Enterprise\retrieve\RetrieveEnterprise;
use App\Application\UseCases\Enterprise\retrieve\RetrieveEnterpriseById;
use App\Application\UseCases\Enterprise\update\UpdateEnterprise;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

interface EnterpriseAPI
{

    #[OA\Post(
        path: "/api/enterprise",
        summary: "Criar empresa",
        tags: ["Enterprise"]
    )]

    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ["name"],
            properties: [
                new OA\Property(
                    property: "name",
                    type: "string",
                    example: "Empresa XPTO"
                )
            ]
        )
    )]

    #[OA\Response(
        response: 201,
        description: "Empresa criada"
    )]

    #[OA\Response(
        response: 400,
        description: "Erro ao criar empresa"
    )]
    public function store(Request $request);

    #[OA\Get(
        path: "/api/enterprise", summary: "Listar empresas", tags: ["Enterprise"]
    )]

    #[OA\Response(
        response: 200,
        description: "Lista de empresas"
    )]
    public function index(RetrieveEnterprise $retrieveEnterprise);

    #[OA\Get(
        path: "/api/enterprise/{id}",
        summary: "Buscar empresa por ID",
        tags: ["Enterprise"]
    )]

    #[OA\Parameter(
        name: "id",
        description: "ID da empresa",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer")
    )]

    #[OA\Response(
        response: 200,
        description: "Empresa encontrada"
    )]

    #[OA\Response(
        response: 404,
        description: "Empresa não encontrada"
    )]
    public function show(int $id, RetrieveEnterpriseById $retrieveEnterpriseById);
    #[OA\Delete(
        path: "/api/enterprise/{id}",
        summary: "Remover empresa",
        tags: ["Enterprise"]
    )]

    #[OA\Parameter(
        name: "id",
        description: "ID da empresa",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer")
    )]

    #[OA\Response(
        response: 200,
        description: "Empresa removida"
    )]

    #[OA\Response(
        response: 404,
        description: "Empresa não encontrada"
    )]
    public function destroy(int $id, DeleteEnterprise $deleteEnterprise);
    #[OA\Put(
        path: "/api/enterprise/{id}",
        summary: "Atualizar empresa",
        tags: ["Enterprise"]
    )]

    #[OA\Parameter(
        name: "id",
        description: "ID da empresa",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer")
    )]

    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ["name"],
            properties: [
                new OA\Property(
                    property: "name",
                    type: "string",
                    example: "Empresa Atualizada"
                )
            ]
        )
    )]

    #[OA\Response(
        response: 200,
        description: "Empresa atualizada"
    )]

    #[OA\Response(
        response: 404,
        description: "Empresa não encontrada"
    )]
    public function update(int $id, Request $request, UpdateEnterprise $updateEnterprise);

}
