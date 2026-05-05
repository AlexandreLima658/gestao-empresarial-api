<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Enterprise\create\CreateEnterprise;
use App\Application\UseCases\Enterprise\Delete\DeleteEnterprise;
use App\Application\UseCases\Enterprise\retrieve\RetrieveEnterprise;
use App\Application\UseCases\Enterprise\retrieve\RetrieveEnterpriseById;
use App\Application\UseCases\Enterprise\update\UpdateEnterprise;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    private CreateEnterprise $createEnterprise;

    public function __construct(CreateEnterprise $createEnterprise)
    {
        $this->createEnterprise = $createEnterprise;
    }

    public function store(Request $request)
    {
        $enterprise = $this->createEnterprise->execute(
            $request->input('name')
        );

        return response()->json([
            'id' => $enterprise->getId(),
            'name' => $enterprise->getName()
        ], 201);
    }

    public function index(RetrieveEnterprise $retrieveEnterprise)
    {
        $enterprises = $retrieveEnterprise->execute();

        return response()->json(
            array_map(function($enterprise){
                return [
                    'id' => $enterprise->getId(),
                    'name' => $enterprise->getName(),
                ];
            }, $enterprises)
        );
    }

    public function show(int $id, RetrieveEnterpriseById $retrieveEnterpriseById)
    {
        try {
            $enterprise = $retrieveEnterpriseById->execute($id);

            return response()->json([
                'id' => $enterprise->getId(),
                'name' => $enterprise->getName()
            ]);

        } catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(int $id, Request $request, UpdateEnterprise $updateEnterprise)
    {
        try {
            $enterprise = $updateEnterprise->execute(
                $id,
                $request->input('name')
            );

            return response()->json([
                'id' => $enterprise->getId(),
                'name' => $enterprise->getName()
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy(int $id, DeleteEnterprise $deleteEnterprise)
    {
        try {
            $deleteEnterprise->execute($id);
            return response()->json([
                'message' => 'Enterprise delete successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],404);
        }
    }

}
