<?php

namespace App\Domain\Commons\Pagination;

/**
 * @template T
 */
readonly class Pagination
{
    /**
     * @param int $currentPage
     * @param int $perPage
     * @param int $total
     * @param array<T> $items
     */
    public function __construct(
        public int $currentPage,
        public int $perPage,
        public int $total,
        public array $items
    )
    {}

    public function map(callable $mapper): Pagination
    {
        $newList = array_map($mapper, $this->items);

        return new Pagination(
            $this->currentPage,
            $this->perPage,
            $this->total,
            $newList
        );
    }
}
