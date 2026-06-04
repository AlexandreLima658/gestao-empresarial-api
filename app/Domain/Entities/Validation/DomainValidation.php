<?php

namespace App\Domain\Entities\Validation;

use App\Domain\Entities\Exception\EntityValidationException;

class DomainValidation
{
    public static function notNull(string $value): void
    {
        if (empty($value))
            throw new EntityValidationException($message ?? 'Value cannot be null.}');

    }
    public static function strMaxLength(string $value, int $length, string $message = ''): void
    {
        if (strlen($value) > $length)
            throw new EntityValidationException($message ?? 'The value must not be greater than {$length} characters}');

    }
}
