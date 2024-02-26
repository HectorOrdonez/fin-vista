<?php

namespace FinVista\Company\Domain\Model;

use Illuminate\Support\Collection;

class CompanyCollection extends Collection
{
    public function toArray(): array
    {
        $data = [];

        foreach($this->items as $company)
        {
            $data[] = [
                'id' => $company->id,
                'name' => $company->name,
                'description' => $company->description,
                'address' => $company->address,
                'industry' => $company->details->industry,
                'currency' => $company->details->currency,
                'dividend_per_share' => $company->details->dividendPerShare,
                'last_50_days_avg' => $company->details->last50DaysAvg,
            ];
        }

        return $data;
    }
}
