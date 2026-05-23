<?php

namespace Tests\Unit;

use App\Domain\Entities\Enterprise\EnterpriseFactory;
use PHPUnit\Framework\TestCase;

class EnterpriseTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_givenAValidParams_whenCallNewEnterprise_thenInstantiateAEnterprise(): void
    {
        $expectedName = "Latam";
        $expectedId = 1;

        $actualEnterprise = EnterpriseFactory::create($expectedId, $expectedName);

        $this->assertNotNull($actualEnterprise);
        $this->assertNotNull($actualEnterprise->getId());
        $this->assertEquals($expectedName, $actualEnterprise->getName());

    }

}
