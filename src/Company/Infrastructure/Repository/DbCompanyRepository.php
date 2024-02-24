<?php

namespace FinVista\Company\Infrastructure\Repository;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\Company;
use FinVista\Company\Domain\Model\CompanyCollection;
use Illuminate\Support\Facades\DB;

class DbCompanyRepository implements CompanyRepositoryInterface
{
    public function __construct()
    {

    }

    public function get(): CompanyCollection
    {

        $results = DB::select('SELECT id, name, description, address FROM companies');

        return new CompanyCollection(
            collect($results)
                ->map(function ($result) {
                    $company              = new Company();
                    $company->id          = $result->id;
                    $company->name        = $result->name;
                    $company->description = $result->description;
                    $company->address     = $result->address;

                    return $company;
                })
        );
    }

    public function create(Company $company): int
    {
        DB::insert('INSERT INTO companies(name, description, address) VALUES(?, ?, ?)', [
            $company->name,
            $company->description,
            $company->address,
        ]);

        $company->id = DB::getPdo()->lastInsertId();

        return $company->id;
    }
}
