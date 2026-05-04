<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Enterprise;

interface EnterpriseRepository
{
   public function salve(Enterprise $enterprise): Enterprise;
   public function list(): array;
}
