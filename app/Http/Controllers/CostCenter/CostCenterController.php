<?php

namespace App\Http\Controllers\CostCenter;

use App\Application\UseCases\CostCenter\create\CreateCostCenter;
use App\Application\UseCases\CostCenter\delete\DeleteCostCenter;
use App\Application\UseCases\CostCenter\retrieve\RetrieveCostCenterByEnterprise;
use App\Application\UseCases\CostCenter\update\UpdateCostCenter;
use App\Http\Controllers\Controller;
use App\Presenters\CostCenterPresenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller implements CostCenterAPI
{

    public function store(Request $request, CreateCostCenter $createCostCenter)
    {
        try {
            $costCenter = $createCostCenter->execute(
                $request->input('enterprise_id'),
                $request->input('name'),
            );

            return response()->json(CostCenterPresenter::toJson($costCenter), 201);

        } catch (\Exception $exception) {
            return response()->json([
               'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function indexByEnterprise(int $enterpriseId, RetrieveCostCenterByEnterprise $useCase)
    {
        try {
            $costCenters = $useCase->execute($enterpriseId);
            return CostCenterPresenter::collection($costCenters);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ],404);
        }
    }

    public function update(int $id, Request $request, UpdateCostCenter $updateCostCenter)
    {
        try {
            $costCenter = $updateCostCenter->execute(
                $id,
                $request->input('name'),
            );

            return response()->json(CostCenterPresenter::toJson($costCenter));

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy(int $id, DeleteCostCenter $delete)
    {
        try {
            $delete->execute($id);
            return response()->json([
                'message' => 'Cost center delete successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],404);
        }
    }
}
