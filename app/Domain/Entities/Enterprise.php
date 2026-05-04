<?php

namespace App\Domain\Entities;

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

    private function valid(string $name): void
    {
        if(empty(trim($name))) {
            throw new \ErrorException("Name is required");
        }
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
