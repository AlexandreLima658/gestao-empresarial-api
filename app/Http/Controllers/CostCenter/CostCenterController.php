<?php

namespace App\Http\Controllers\CostCenter;

use App\Application\UseCases\CostCenter\create\CreateCostCenterInput;
use App\Application\UseCases\CostCenter\create\CreateCostCenterUseCase;
use App\Application\UseCases\CostCenter\delete\DeleteCostCenter;
use App\Application\UseCases\CostCenter\retrieve\RetrieveCostCenterByEnterprise;
use App\Application\UseCases\CostCenter\update\UpdateCostCenterInput;
use App\Application\UseCases\CostCenter\update\UpdateCostCenterUseCase;
use App\Http\Controllers\Controller;
use App\Presenters\CostCenterPresenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller implements CostCenterAPI
{
    public function __construct(
        private CreateCostCenterUseCase $createCostCenter,
        private RetrieveCostCenterByEnterprise $retrieveCostCenter,
        private UpdateCostCenterUseCase $updateCostCenter,
        private DeleteCostCenter $delete
    )
    {}
    public function store(Request $request)
    {
        try {
            $costCenter = $this->createCostCenter->execute(CreateCostCenterInput::from($request));

            return response()->json(
                CostCenterPresenter::toResponseCreate($costCenter),
                201
            );

        } catch (\Exception $exception) {
            return response()->json([
               'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function indexByEnterprise(int $enterpriseId)
    {
        try {
            $costCenters = $this->retrieveCostCenter->execute($enterpriseId);
            return CostCenterPresenter::collection($costCenters);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ],404);
        }
    }

    public function update(int $id, Request $request)
    {
        try {
            $costCenter = $this->updateCostCenter->execute(
                UpdateCostCenterInput::from($id, $request)
            );

            return response()->json(CostCenterPresenter::toResponseUpdate($costCenter));

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->delete->execute($id);
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
