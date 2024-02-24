<?php

namespace FinVista\Company\Application\UseCase;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use FinVista\Company\Domain\Model\CompanyCollection;

class GetCompanies
{
    public function __construct(private readonly CompanyRepositoryInterface $companyRepository)
    {

    }

    public function __invoke(): CompanyCollection
    {
        return $this->companyRepository->get();
    }
}
