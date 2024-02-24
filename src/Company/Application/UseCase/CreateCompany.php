<?php

namespace FinVista\Company\Application\UseCase;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\Company;
use Illuminate\Http\Request;

class CreateCompany
{
    public function __construct(private CompanyRepositoryInterface $companyRepository)
    {

    }

    public function __invoke(Request $request)
    {
        $company = Company::make([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'address' => $request->get('address'),
        ]);

        $this->companyRepository->create($company);
    }
}
