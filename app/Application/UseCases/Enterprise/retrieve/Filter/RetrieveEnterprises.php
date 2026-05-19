<?php

namespace App\Application\UseCases\Enterprise\retrieve\Filter;

use App\Domain\Commons\Pagination\Pagination;

interface RetrieveEnterprises
{
    /**
     * @param RetrieveEnterprisesInput $input
     * @return Pagination<RetrieveEnterprisesOutput>
     */
    public function execute(RetrieveEnterprisesInput $input): Pagination;
}
