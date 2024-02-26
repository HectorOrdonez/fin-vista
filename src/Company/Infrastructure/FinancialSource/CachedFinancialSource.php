<?php

namespace FinVista\Company\Infrastructure\FinancialSource;

use FinVista\Company\Domain\ExternalFinancialSourceInterface;
use FinVista\Company\Domain\Model\FinancialDetails;
use Illuminate\Cache\CacheManager;

class CachedFinancialSource implements ExternalFinancialSourceInterface
{
    private const string CACHE_KEY = 'finance.%s';
    private const int SECONDS = 60;

    public function __construct(
        private CacheManager                     $cache,
        private ExternalFinancialSourceInterface $source,
    )
    {
    }

    public function getDetails(string $name): FinancialDetails
    {
        return $this->cache->remember($this->makeKey($name), self::SECONDS, function () use ($name) {
            return $this->source->getDetails($name);
        });
    }

    private function makeKey(string $name)
    {
        return sprintf(self::CACHE_KEY, $name);
    }
}
