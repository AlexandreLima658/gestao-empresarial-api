<?php

namespace App\Application\UseCases\Enterprise\retrieve\Filter;

use App\Domain\Commons\Pagination\Pagination;
use Illuminate\Http\Request;

readonly class RetrieveEnterprisesInput
{
    public function __construct(
        public int $page,
        public int $perPage,
        public string $sortBy,
        public string $query,
        public string $sort_direction,
    )
    {}

    public static function toInput(Request $request): self
    {
        return new self(
            $request->query('page', 0),
            $request->query('perPage', 10),
            $request->query('sortBy', 'name'),
            $request->query('query', ''),
            $request->query('sort_direction', 'asc')
        );
    }

}
