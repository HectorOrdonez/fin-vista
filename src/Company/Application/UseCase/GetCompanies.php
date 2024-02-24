<?php

namespace FinVista\Company\Application\UseCase;

use FinVista\Company\Domain\CompanyRepositoryInterface;
use Illuminate\View\View;

class GetCompanies
{
    public function __construct(private readonly CompanyRepositoryInterface $companyRepository)
    {

    }

    public function __invoke(): View
    {
        $companies = $this->companyRepository->get();

        return view('company::companies', compact('companies'));
    }
}
