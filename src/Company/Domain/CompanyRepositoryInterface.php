<?php

namespace FinVista\Company\Domain;

use FinVista\Company\Domain\Model\Company;

interface CompanyRepositoryInterface
{
    public function create(Company $company): int;
}
