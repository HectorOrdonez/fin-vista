<?php

namespace FinVista\Company\Application\Livewire;

use FinVista\Company\Application\UseCase\GetCompanies;
use FinVista\Company\Domain\Model\CompanyCollection;
use Livewire\Component;

class CompanyListing extends Component
{
    public CompanyCollection $companies;

    public function mount(GetCompanies $getCompanies)
    {
        $this->companies = $getCompanies();
    }

    public function render()
    {
        return view('company::livewire.company-listing');
    }
}
