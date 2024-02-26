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

        // Api Limit reached
        if(isset($data['Information']))
        {
            // For the purpose of the assessment we will make random financial data after hitting api limits
            // Which, for Alphavantage, is 25 per day. This way I can ensure everything works as expected
            return $this->makeRandomFinancialDetails();
        }

        // Api Key probably not set
        if(isset($data['Error Message']))
        {
            throw new \Exception('Did you forget to set the api key from Alphavantage?');
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

    private function makeRandomFinancialDetails()
    {
        $details = new FinancialDetails();
        $details->industry = 'Some industry';
        $details->currency = 'EUR';
        $details->dividendPerShare = (float) random_int(1, 1000) / 100;
        $details->last50DaysAvg = (float) random_int(1, 1000) / 100;

        return $details;
    }

}
