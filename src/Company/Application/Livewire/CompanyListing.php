<?php

namespace FinVista\Company\Application\Livewire;

use FinVista\Company\Application\UseCase\GetCompanies;
use FinVista\Company\Domain\Model\CompanyCollection;
use Livewire\Component;

class CompanyListing extends Component
{
    public array $companies;

    public function render(GetCompanies $getCompanies)
    {
        $this->companies = ($getCompanies)()->toArray();

        return view('company::livewire.company-listing');
    }
}
