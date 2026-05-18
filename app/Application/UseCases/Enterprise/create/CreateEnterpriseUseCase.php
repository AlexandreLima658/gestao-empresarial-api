<?php

namespace App\Application\UseCases\Enterprise\create;

use App\Application\UseCases\UseCase;
use App\Domain\Entities\Enterprise\EnterpriseFactory;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;

/**
 * @extends UseCase<CreateEnterpriseInput, CreateEnterpriseOutput>
 */
class CreateEnterpriseUseCase extends UseCase
{
    private EnterpriseRepository $repository;

    public function __construct(EnterpriseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateEnterpriseInput $input
     * @return CreateEnterpriseOutput
     */
    public function execute($input): CreateEnterpriseOutput
    {
        $enterprise = EnterpriseFactory::createWithIdNull($input->name);
        $model = $this->repository->save($enterprise);

        return new CreateEnterpriseOutput(
            $model->getId(),
            $enterprise->getName()
        );
    }
}
