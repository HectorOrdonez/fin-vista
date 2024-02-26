<?php

namespace FinVista\Company\Domain;

use FinVista\Company\Domain\Model\FinancialDetails;

interface ExternalFinancialSourceInterface
{
    public function getDetails(string $name): FinancialDetails;
}
