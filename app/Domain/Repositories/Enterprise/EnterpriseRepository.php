<?php

namespace App\Domain\Repositories\Enterprise;

use App\Domain\Commons\Pagination\Pagination;
use App\Domain\Entities\Enterprise\Enterprise;

interface EnterpriseRepository
{
   public function save(Enterprise $enterprise): Enterprise;
   public function findById(int $id): ?Enterprise;
   public function delete(int $id): void;
   public function update(Enterprise $enterprise): Enterprise;

}
