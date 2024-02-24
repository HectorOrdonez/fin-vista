<?php

namespace FinVista\Company\Infrastructure\Repository;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\Company;
use Illuminate\Support\Facades\DB;

class DbCompanyRepository implements CompanyRepositoryInterface
{
    public function __construct()
    {

    }

    public function create(Company $company): int
    {
        DB::insert('INSERT INTO companies(name, description, address) VALUES(?, ?, ?)', [
            $company->name,
            $company->description,
            $company->address,
        ]);

        return DB::getPdo()->lastInsertId();
    }
}
