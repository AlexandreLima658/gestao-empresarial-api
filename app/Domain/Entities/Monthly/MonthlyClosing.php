<?php

namespace App\Domain\Entities\Monthly;

use App\Domain\Entities\Monthly\ValueObject\Month;

class MonthlyClosing
{
    private ?int $id;
    private int $enterpriseId;
    private Month $month;
    private int $year;
    private bool $closed;

    /**
     * @param int|null $id
     * @param int $enterpriseId
     * @param Month $month
     * @param int $year
     * @param bool $closed
     */
    public function __construct(
        ?int $id,
        int $enterpriseId,
        Month $month,
        int $year,
        bool $closed
    )
    {
        $this->id = $id;
        $this->enterpriseId = $enterpriseId;
        $this->month = $month;
        $this->year = $year;
        $this->closed = $closed;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnterpriseId(): int
    {
        return $this->enterpriseId;
    }

    public function getMonth(): Month
    {
        return $this->month;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function isClosed(): bool
    {
        return $this->closed;
    }

}
