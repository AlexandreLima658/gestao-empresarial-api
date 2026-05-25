<?php

use App\Domain\Entities\Monthly\MonthlyClosing;
use App\Domain\Entities\Monthly\MonthlyClosingFactory;

it('should create a new MonthlyClosing', function () {
    $monthId = 1;
    $enterpriseId = 1;
    $month = 3;
    $year = 1;

    $monthClosing = MonthlyClosingFactory::create(
        $monthId,
        $enterpriseId,
        $month,
        $year,
        true
    );

    expect($monthClosing)->toBeInstanceOf(MonthlyClosing::class)
        ->and($monthId)->toBe($monthClosing->getId());
});

it('should return exception when month is invalid', function () {
    $monthId = 1;
    $enterpriseId = 1;
    $month = 13;
    $year = 1;
    $expectedMessageError = "Value must be between 1 and 12";

    $monthClosing = fn() => MonthlyClosingFactory::create(
        $monthId,
        $enterpriseId,
        $month,
        $year,
        true
    );

    expect($monthClosing)->toThrow(
        Exception::class,
        $expectedMessageError
    );
});
