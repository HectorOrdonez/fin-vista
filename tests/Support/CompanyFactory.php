<?php

namespace Tests\Support;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\Company;

class CompanyFactory
{
    public static function create($overridingAttributes = []): Company
    {
        $attributes = array_merge(self::getDefaults(), $overridingAttributes);

        $companyRepository = app(CompanyRepositoryInterface::class);
        $company           = new Company();

        $company->name        = $attributes['name'];
        $company->description = $attributes['description'];
        $company->address     = $attributes['address'];

        $companyRepository->create($company);

        return $company;
    }

    private static function getDefaults(): array
    {
        return [
            'name' => 'some name',
            'description' => 'some description',
            'address' => 'some address',
        ];
    }
}
