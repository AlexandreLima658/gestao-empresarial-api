<?php

use App\Domain\Entities\Enterprise\Enterprise;
use App\Domain\Entities\Enterprise\EnterpriseFactory;
use App\Domain\Entities\Exception\EntityValidationException;


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
    expect($enterprise)->toThrow(EntityValidationException::class, $expectedMessageError);

});

it("should update a enterprise", function () {
   $expectedId = 1;
   $expectedName = "Latam";

   $enterprise = EnterpriseFactory::create($expectedId, $expectedName);

   $newName = "Gol";
   $enterprise->updateEnterprise($newName);

   expect($enterprise->getId())->toEqual($expectedId)
       ->and($enterprise->getName())->toBe($newName);

});

