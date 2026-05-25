<?php

use App\Domain\Entities\Financial\FinancialEntry;
use App\Domain\Entities\Financial\FinancialEntryFactory;
use App\Domain\Enums\FinancialEntryType;

it('should create a new financial entry', function () {
    $expectedId = 1;
    $enterpriseId = 1;
    $costCenterId = 1;
    $description = "some description";
    $amount = 15999;
    $type = FinancialEntryType::EXPENSE;
    $entryDate = '2026-05-07';

    $financialEntry = FinancialEntryFactory::create(
        $expectedId,
        $enterpriseId,
        $costCenterId,
        $description,
        $amount,
        $type,
        $entryDate,
    );

    expect($financialEntry)->toBeInstanceOf(FinancialEntry::class)
        ->and($financialEntry->getId())->toBe($expectedId)
        ->and($financialEntry->getDescription())->toBe($description);

});

it('should throw an exception when the value is less than zero.', function () {
    $expectedId = 1;
    $enterpriseId = 1;
    $costCenterId = 1;
    $description = "some description";
    $amount = -10;
    $type = FinancialEntryType::EXPENSE;
    $entryDate = '2026-05-07';
    $expectedMessageError = 'Amount must be greater than 0!';

    $financialEntry = fn() => FinancialEntryFactory::create(
        $expectedId,
        $enterpriseId,
        $costCenterId,
        $description,
        $amount,
        $type,
        $entryDate,
    );
    expect($financialEntry)->toThrow(
        Exception::class,
        $expectedMessageError
    );
});

it('should return exception when description is empty', function () {
    $expectedId = 1;
    $enterpriseId = 1;
    $costCenterId = 1;
    $description = " ";
    $amount = 15999;
    $type = FinancialEntryType::EXPENSE;
    $entryDate = '2026-05-07';
    $expectedMessageError = 'Description is required!';

    $financialEntry = fn() => FinancialEntryFactory::create(
        $expectedId,
        $enterpriseId,
        $costCenterId,
        $description,
        $amount,
        $type,
        $entryDate,
    );

    expect($financialEntry)->toThrow(
        Exception::class,
        $expectedMessageError
    );
});
