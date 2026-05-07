<?php

namespace App\Domain\Entities\Financial;
use App\Domain\Enums\FinancialEntryType;

class FinancialEntry
{
    private ?int $id;
    private int $enterpriseId;
    private int $costCenterId;
    private string $description;
    private float $amount;
    private FinancialEntryType $type;
    private string $entryDate;

    public function __construct(
        ?int $id,
        int $enterpriseId,
        int $costCenterId,
        string $description,
        float $amount,
        FinancialEntryType $type,
        string $entryDate
    )
    {
        $this->validate(
            $this->description = $description,
            $this->amount = $amount,

        );
        $this->id = $id;
        $this->enterpriseId = $enterpriseId;
        $this->costCenterId = $costCenterId;
        $this->entryDate = $entryDate;
        $this->type = $type;
    }

    public function validate(string $description, float $amount): void
    {
        if(empty(trim($description))) {
            throw new \Exception('Description is required!');
        }

        if($amount < 0) {
            throw new \Exception('Amount must be greater than 0!');
        }

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnterpriseId(): int
    {
        return $this->enterpriseId;
    }

    public function getCostCenterId(): int
    {
        return $this->costCenterId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getType(): FinancialEntryType
    {
        return $this->type;
    }

    public function getEntryDate(): string
    {
        return $this->entryDate;
    }



}
