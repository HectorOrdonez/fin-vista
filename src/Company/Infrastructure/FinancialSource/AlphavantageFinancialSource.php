<?php

namespace FinVista\Company\Infrastructure\FinancialSource;

use FinVista\Company\Domain\ExternalFinancialSourceInterface;
use FinVista\Company\Domain\Model\FinancialDetails;
use GuzzleHttp\Client;

class AlphavantageFinancialSource implements ExternalFinancialSourceInterface
{
    private const UNKNOWN = 'unknown';
    private const URL = 'https://www.alphavantage.co/query?function=OVERVIEW&symbol=%s&apikey=%s';

    public function __construct(private Client $client, private string $apiKey)
    {

    }

    public function getDetails(string $name): FinancialDetails
    {
        $url = sprintf(self::URL, $name, $this->apiKey);

        $encoded = $this->client->get($url)->getBody()->getContents();
        $data = json_decode($encoded, true);

        if(empty($data))
        {
            return $this->makeUnknownFinancialDetails();
        }

        $details = new FinancialDetails();
        $details->industry = $data['Industry'];
        $details->currency = $data['Currency'];
        $details->dividendPerShare = $data['DividendPerShare'];
        $details->last50DaysAvg = $data['50DayMovingAverage'];

        return $details;
    }

    private function makeUnknownFinancialDetails(): FinancialDetails
    {
        $details = new FinancialDetails();
        $details->industry = self::UNKNOWN;
        $details->currency = self::UNKNOWN;
        $details->dividendPerShare = 0;
        $details->last50DaysAvg = 0;

        return $details;
    }

}
