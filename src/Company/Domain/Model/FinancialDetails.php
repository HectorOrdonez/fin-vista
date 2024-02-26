<?php

namespace FinVista\Company\Domain\Model;

class FinancialDetails
{
    public string $industry;
    public string $currency;
    public float $dividendPerShare;
    public float $last50DaysAvg;
}
