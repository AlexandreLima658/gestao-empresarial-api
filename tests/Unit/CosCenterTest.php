<?php

use App\Domain\Entities\CostCenter\CostCenter;
use App\Domain\Entities\CostCenter\CostCenterFactory;

it('should create a new cost center', function () {
    $expectedId = 1;
    $expectedName = 'CosCenter';
    $enterpriseId = 1;

    $costCenter = CostCenterFactory::create($expectedId, $enterpriseId, $expectedName);

    expect($costCenter)->toBeInstanceOf(CostCenter::class)
        ->and($expectedId)->toBe($costCenter->getId())
        ->and($expectedName)->toBe($costCenter->getName());
});

it('should return exception when name is empty', function () {
    $expectedId = 1;
    $expectedName = ' ';
    $enterpriseId = 1;
    $expectedMessageError = "Name is required";

    $costCenter = fn() => CostCenterFactory::create(
        $expectedId,
        $enterpriseId,
        $expectedName
    );

    expect($costCenter)->toThrow(
        Exception::class,
        $expectedMessageError
    );
});

