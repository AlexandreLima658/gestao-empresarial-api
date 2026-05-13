<?php

namespace App\Http\Controllers\Enterprise;

use App\Application\UseCases\Enterprise\create\CreateEnterprise;
use App\Application\UseCases\Enterprise\Delete\DeleteEnterprise;
use App\Application\UseCases\Enterprise\retrieve\RetrieveEnterprise;
use App\Application\UseCases\Enterprise\retrieve\RetrieveEnterpriseById;
use App\Application\UseCases\Enterprise\update\UpdateEnterprise;
use App\Http\Controllers\Controller;
use App\Presenters\EnterprisePresenter;
use Illuminate\Http\Request;

class EnterpriseController extends Controller implements EnterpriseAPI
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

        return response()->json(EnterprisePresenter::toJson($enterprise));
    }

    public function index(RetrieveEnterprise $retrieveEnterprise)
    {
        $enterprises = $retrieveEnterprise->execute();

        return response()->json(EnterprisePresenter::collection($enterprises));
    }
    public function update(int $id, Request $request, UpdateEnterprise $updateEnterprise)
    {
        try {
            $enterprise = $updateEnterprise->execute(
                $id,
                $request->input('name')
            );

            return response()->json(EnterprisePresenter::toJson($enterprise));
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


    public function show(int $id, RetrieveEnterpriseById $retrieveEnterpriseById)
    {
        try {
            $enterprise = $retrieveEnterpriseById->execute($id);
            return response()->json(EnterprisePresenter::toJson($enterprise));

        } catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

}
