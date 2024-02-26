<?php

namespace FinVista\Company\Application\Livewire;

use FinVista\Company\Application\UseCase\CreateCompany;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class CompanyCreate extends Component
{
    public string $name;
    public string $description;
    public string $address;

    protected array $rules = [
        'name' => 'required|string|min:5',
        'description' => 'required|min:10',
        'address' => 'required|min:10',
    ];

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submit(CreateCompany $createCompany): void
    {
        ($createCompany)($this->name, $this->description, $this->address);

        $this->redirect(route('companies.index'));
    }

    public function render()
    {
        return view('company::livewire.company-create');
    }
}
