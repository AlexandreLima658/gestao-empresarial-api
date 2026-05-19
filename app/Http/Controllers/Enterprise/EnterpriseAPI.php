<?php

namespace App\Http\Controllers\Enterprise;
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
        path: "/api/enterprise",
        summary: "Listar empresas",
        tags: ["Enterprise"]
    )]
    #[OA\Parameter(
        name: "page",
        in: "query",
        description: "Número da página atual",
        required: false,
        schema: new OA\Schema(type: "integer", default: 1)
    )]
    #[OA\Parameter(
        name: "perPage",
        in: "query",
        description: "Quantidade de itens por página",
        required: false,
        schema: new OA\Schema(type: "integer", default: 10)
    )]
    #[OA\Parameter(
        name: "sort",
        in: "query",
        description: "Coluna para ordenação",
        required: false,
        schema: new OA\Schema(type: "string", default: "name")
    )]
    #[OA\Parameter(
        name: "direction",
        in: "query",
        description: "Direção da ordenação (asc ou desc)",
        required: false,
        schema: new OA\Schema(type: "string", enum: ["asc", "desc"], default: "asc")
    )]
    #[OA\Parameter(
        name: "query",
        in: "query",
        description: "Termo para busca/filtro",
        required: false,
        schema: new OA\Schema(type: "string")
    )]
    #[OA\Response(
        response: 200,
        description: "Lista de empresas paginada",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "current_page", type: "integer", example: 1),
                new OA\Property(property: "per_page", type: "integer", example: 10),
                new OA\Property(property: "total", type: "integer", example: 30),
                new OA\Property(
                    property: "items",
                    type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 1),
                            new OA\Property(property: "name", type: "string", example: "Empresa ACME"),
                        ]
                    )
                )
            ]
        )
    )]
    public function index(Request $request);
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
    public function show(int $id);
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
    public function destroy(int $id);
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
    public function update(int $id, Request $request);

}
