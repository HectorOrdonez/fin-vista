<?php

namespace FinVista\Company\Infrastructure\Repository;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\Company;

class DbCompanyRepository implements CompanyRepositoryInterface
{
    public function create(Company $company): void
    {
        $company->save();
    }
}
