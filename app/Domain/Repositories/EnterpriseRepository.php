<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Enterprise;

interface EnterpriseRepository
{
   public function save(Enterprise $enterprise): Enterprise;
   public function findAll(): array;
   public function findById(int $id): ?Enterprise;
   public function update(Enterprise $enterprise): Enterprise;

}
