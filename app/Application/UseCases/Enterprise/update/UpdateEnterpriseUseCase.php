<?php

namespace App\Application\UseCases\Enterprise\update;

use App\Application\UseCases\UseCase;
use App\Domain\Repositories\Enterprise\EnterpriseRepository;

/**
 * @extends UseCase<UpdateEnterpriseInput, UpdateEnterpriseOutput>
 */
class UpdateEnterpriseUseCase extends UseCase
{
    private EnterpriseRepository $repository;

    public function __construct(EnterpriseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UpdateEnterpriseInput $input
     * @return UpdateEnterpriseOutput
     * @throws \Exception
     */
    public function execute($input): UpdateEnterpriseOutput
    {
        $enterprise = $this->repository->findById($input->id);

        if(!$enterprise){
            throw new \Exception("Enterprise not found!");
        }

        $enterprise->updateEnterprise($input->name);

        $this->repository->update($enterprise);

        return new UpdateEnterpriseOutput(
           $enterprise->getId(),
           $enterprise->getName()
        );
    }
}
