<?php

namespace App\Domain\Entities\CostCenter;

class CostCenter
{
    private ?int $id;
    private int $enterpriseId;
    private string $name;


    public function __construct(?int $id, int $enterpriseId, string $name)
    {
        $this->valid($name);

        $this->id = $id;
        $this->enterpriseId = $enterpriseId;
        $this->name = $name;
    }


    private function valid(string $name): void
    {
        if (empty(trim($name))) {
            throw new \Exception("Name is required!");
        }
    }

    public function updateName(string $name): void
    {
        $this->valid($name);
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnterpriseId(): int
    {
        return $this->enterpriseId;
    }

    public function getName(): string
    {
        return $this->name;
    }




}
