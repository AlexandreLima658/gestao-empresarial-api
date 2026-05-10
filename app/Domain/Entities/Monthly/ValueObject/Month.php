<?php

namespace App\Domain\Entities\Monthly\ValueObject;

class Month
{
    private int $value;

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    private function validate(int $value): void
    {
        if ($value < 1 || $value > 12) {
            throw new \Exception("Value must be between 1 and 12");
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public static function fromInt(int $value): Month
    {
        return new Month($value);
    }

    public static function from(Month $month): int
    {
        return $month->value();
    }


}
