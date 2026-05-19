<?php

namespace App\Infrastructure\Repositories\Implementations;

use App\Application\UseCases\Enterprise\retrieve\Filter\RetrieveEnterprises;
use App\Application\UseCases\Enterprise\retrieve\Filter\RetrieveEnterprisesInput;
use App\Application\UseCases\Enterprise\retrieve\Filter\RetrieveEnterprisesOutput;
use App\Domain\Commons\Pagination\Pagination;
use App\Models\EnterpriseModel;

class RetrieveEnterprisesImpl implements RetrieveEnterprises
{
    public function __construct(
        private EnterpriseModel $model
    )
    {}

    /**
     * @param RetrieveEnterprisesInput $input
     * @return Pagination<RetrieveEnterprisesOutput>
     */
    public function execute(RetrieveEnterprisesInput $input): Pagination
    {
        $query = $this->applyFilters($input->query);

        $paginator = $query->orderBy($input->sortBy, $input->sortDirection)
            -> paginate(
                $input->perPage,
                ['*'],
             'page',
                $input->page
        );

        $mapperItems = $paginator->getCollection()
            ->map(fn($item) => $this->mapperFrom($item))
            ->toArray();

        return new Pagination(
            $paginator->currentPage(),
            $paginator->perPage(),
            $paginator->total(),
            $mapperItems
        );
    }
    private function mapperFrom(EnterpriseModel $enterprise): RetrieveEnterprisesOutput
    {
        return new RetrieveEnterprisesOutput(
            $enterprise->id,
            $enterprise->name,
        );
    }

    private function applyFilters(?string $term)
    {
        $query = $this->model->newQuery();

        if(!empty(trim($term))){
            $query->where('name', 'LIKE', '%' . $term . '%');
        }
        return $query;
    }

}
