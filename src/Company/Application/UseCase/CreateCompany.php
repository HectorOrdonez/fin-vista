<?php

namespace FinVista\Company\Application\UseCase;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\Company;

class CreateCompany
{
    public function __construct(private readonly CompanyRepositoryInterface $companyRepository)
    {

    }

    public function __invoke(string $name, string $description, string $address): void
    {
        $company              = new Company();
        $company->name        = $name;
        $company->description = $description;
        $company->address     = $address;

        $this->companyRepository->create($company);
    }
}
