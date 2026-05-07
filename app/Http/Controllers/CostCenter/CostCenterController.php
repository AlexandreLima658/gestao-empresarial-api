<?php

namespace App\Http\Controllers\CostCenter;

use App\Application\UseCases\CostCenter\create\CreateCostCenter;
use App\Application\UseCases\CostCenter\retrieve\RetrieveCostCenterByEnterprise;
use App\Application\UseCases\CostCenter\update\UpdateCostCenter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{

    public function store(Request $request, CreateCostCenter $createCostCenter)
    {
        try {
            $costCenter = $createCostCenter->execute(
                $request->input('enterprise_id'),
                $request->input('name'),
            );

            return response()->json([
                'id' => $costCenter->getId(),
                'enterprise_id' => $costCenter->getEnterpriseId(),
                'name' => $costCenter->getName(),
            ], 201);

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

            return $costCenters->map(fn($item) => [
                'id' => $item->getId(),
                'enterprise_id' => $item->getEnterpriseId(),
                'name' => $item->getName(),
            ]);

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

            return response()->json([
                'id' => $costCenter->getId(),
                'enterprise_id' => $costCenter->getEnterpriseId(),
                'name' => $costCenter->getName(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
