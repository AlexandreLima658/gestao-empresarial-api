<?php

namespace App\Domain\Entities\Enterprise;

use App\Domain\Entities\Exception\EntityValidationException;

class Enterprise
{
    private ?int $id;
    private string $name;

    public function __construct(?int $id, string $name)
    {
        $this->valid($name);
        $this->id = ($id);
        $this->name = ($name);
    }

    /**
     * @throws \Exception
     */
    private function valid(string $name): void
    {
        if(empty(trim($name))) {
            throw new EntityValidationException("Name enterprise is required");
        }
    }

    public function updateEnterprise(string $name): void
    {
        $this->valid($name);
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
