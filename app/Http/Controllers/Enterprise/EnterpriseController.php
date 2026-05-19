<?php

namespace App\Http\Controllers\Enterprise;

use App\Application\UseCases\Enterprise\create\CreateEnterpriseInput;
use App\Application\UseCases\Enterprise\create\CreateEnterpriseUseCase;
use App\Application\UseCases\Enterprise\Delete\DeleteEnterprise;
use App\Application\UseCases\Enterprise\retrieve\Filter\RetrieveEnterprisesInput;
use App\Application\UseCases\Enterprise\retrieve\Id\RetrieveEnterpriseById;
use App\Application\UseCases\Enterprise\update\UpdateEnterpriseInput;
use App\Application\UseCases\Enterprise\update\UpdateEnterpriseUseCase;
use App\Http\Controllers\Controller;
use App\Infrastructure\Repositories\Implementations\RetrieveEnterprisesImpl;
use App\Presenters\EnterprisePresenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnterpriseController extends Controller implements EnterpriseAPI
{
    private CreateEnterpriseUseCase $createEnterprise;
    private RetrieveEnterprisesImpl $retrieveEnterprise;
    private RetrieveEnterpriseById $retrieveEnterpriseById;
    private UpdateEnterpriseUseCase $updateEnterprise;
    private DeleteEnterprise $deleteEnterprise;

    public function __construct(
        CreateEnterpriseUseCase $createEnterprise,
        RetrieveEnterprisesImpl $retrieveEnterprise,
        RetrieveEnterpriseById  $retrieveEnterpriseById,
        UpdateEnterpriseUseCase $updateEnterprise,
        DeleteEnterprise        $deleteEnterprise


    )
    {
        $this->createEnterprise = $createEnterprise;
        $this->retrieveEnterprise = $retrieveEnterprise;
        $this->retrieveEnterpriseById = $retrieveEnterpriseById;
        $this->updateEnterprise = $updateEnterprise;
        $this->deleteEnterprise = $deleteEnterprise;
    }

    public function store(Request $request)
    {
        $enterprise = $this->createEnterprise->execute(
            CreateEnterpriseInput::from($request)
        );

        return response()->json(EnterprisePresenter::toJsonCreate($enterprise));
    }

    public function index(Request $request): JsonResponse
    {
        $input = RetrieveEnterprisesInput::toInput($request);

        $pagination = $this->retrieveEnterprise->execute($input);

        return response()->json(
            EnterprisePresenter::present($pagination)
        );
    }
    public function update(int $id, Request $request)
    {
        try {
            $enterprise = $this->updateEnterprise->execute(
                UpdateEnterpriseInput::from($id, $request)
            );

            return response()->json(
                EnterprisePresenter::toJsonUpdate($enterprise)
            );

        } catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->deleteEnterprise->execute($id);
            return response()->json([
                'message' => 'Enterprise delete successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],404);
        }
    }


    public function show(int $id)
    {
        try {
            $enterprise = $this->retrieveEnterpriseById->execute($id);

            return response()->json(
                EnterprisePresenter::toJson($enterprise)
            );

        } catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

}
