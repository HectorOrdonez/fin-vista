<?php

namespace FinVista\Company\Domain;

use FinVista\Company\Domain\Model\Company;
use FinVista\Company\Domain\Model\CompanyCollection;

interface CompanyRepositoryInterface
{
    public function create(Company $company): int;

    /** @return CompanyCollection|Company[] */
    public function get(): CompanyCollection|array;
}
