<?php

use App\Domain\Entities\Enterprise\Enterprise;
use App\Domain\Entities\Enterprise\EnterpriseFactory;


it('should create a new enterprise', function () {
    $expectedName = "Latam";
    $expectedId = 1;

    $enterprise = EnterpriseFactory::create($expectedId, $expectedName);

    expect($enterprise)->toBeInstanceOf(Enterprise::class)
        ->and($enterprise->getId())->toBe($expectedId)
        ->and($enterprise->getName())->toBe($expectedName);
});

it('should return exception when name is empty', function () {
    $expectedName = "";
    $expectedId = 1;
    $expectedMessageError = "Name enterprise is required";

    $enterprise = fn() => EnterpriseFactory::create($expectedId, $expectedName);
    expect($enterprise)->toThrow(Exception::class, $expectedMessageError);

});
