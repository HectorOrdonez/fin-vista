<?php

namespace Tests\Integration\Company;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyRepositoryTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_company_and_returns_its_id(): void
    {
        // Arrange
        $name        = $this->faker->company;
        $description = $this->faker->text;
        $address     = $this->faker->address;

        $company              = new Company();
        $company->name        = $name;
        $company->description = $description;
        $company->address     = $address;

        $companyRepository = app(CompanyRepositoryInterface::class);

        // Act
        $id = $companyRepository->create($company);

        // Assert
        $this->assertDatabaseHas('companies', [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'address' => $address,
        ]);
    }

}
