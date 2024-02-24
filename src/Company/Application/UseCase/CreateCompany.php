<?php

namespace FinVista\Company\Application\UseCase;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateCompany
{
    public function __construct(private readonly CompanyRepositoryInterface $companyRepository)
    {

    }

    public function __invoke(Request $request): Response
    {
        $company = new Company();
        $company->name = $request->get('name');
        $company->description = $request->get('description');
        $company->address = $request->get('address');

        $this->companyRepository->create($company);

        return response('', 201);
    }
}
