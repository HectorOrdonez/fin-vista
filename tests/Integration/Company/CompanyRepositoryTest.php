<?php

namespace Tests\Integration\Company;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\Company;
use FinVista\Company\Domain\Model\CompanyCollection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Support\CompanyFactory;
use Tests\TestCase;

class CompanyRepositoryTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function create_creates_a_company_and_returns_its_id(): void
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

    /** @test */
    public function get_returns_3_companies_when_3_companies_exist(): void
    {
        // Arrange
        $company1 = CompanyFactory::create();
        $company2 = CompanyFactory::create();
        $company3 = CompanyFactory::create();

        $companyRepository = app(CompanyRepositoryInterface::class);
        assert($companyRepository instanceof CompanyRepositoryInterface);

        // Act
        $companies = $companyRepository->get();

        // Assert
        $this->assertInstanceOf(CompanyCollection::class, $companies);
        $this->assertEquals($company1, $companies[0]);
        $this->assertEquals($company2, $companies[1]);
        $this->assertEquals($company3, $companies[2]);
    }

}
