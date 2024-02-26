<?php

namespace FinVista\Company\Application\UseCase;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\ExternalFinancialSourceInterface;
use FinVista\Company\Domain\Model\CompanyCollection;

class GetCompanies
{
    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly ExternalFinancialSourceInterface $financialSource,
    )
    {

    }

    public function __invoke(): CompanyCollection
    {
        $companies = $this->companyRepository->get();

        foreach($companies as $company)
        {
            $company->details = $this->financialSource->getDetails($company->name);
        }

        return $companies;
    }
}
