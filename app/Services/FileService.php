<?php

namespace App\Services;

use App\DTO\ParsedData;
use App\Exceptions\FileServiceFetchException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FileService
{
    public string $fileUrl;
    public string $cacheKey;

    public function __construct()
    {
        $this->fileUrl = config('services.file_service.url');
        $this->cacheKey = config('services.file_service.cache_key');
    }

    /**
     * @throws FileServiceFetchException
     */
    public function getData(): array
    {
        if ($this->hasCache()) {
           return $this->getCachedData();
        }
        $data = $this->fetchData();
        $parsedData = $this->parseData($data)->getData();
        Cache::put($this->cacheKey, $parsedData);
        return $parsedData;add
    }

    public function hasCache(): bool
    {
        return Cache::has($this->cacheKey);
    }

    public function getCachedData(): array
    {
        return Cache::get($this->cacheKey);
    }

    /**
     * @throws FileServiceFetchException
     */
    public function cacheData(): void
    {
        Cache::put($this->cacheKey, $this->parseData($this->fetchData())->getData());
    }

    public function parseData(array $data): ParsedData
    {
        $parsedData = [];
        foreach ($data['items'] as $item) {
            $urlParts = parse_url($item['fileUrl']);
            $pathParts = explode('/', $urlParts['path']);
            $host = $urlParts['host'];
            $file = last($pathParts);

            $currentArray = &$parsedData[$host];


            foreach ($pathParts as $directory) {
                if ($directory === '') {
                    // skip empty first
                    continue;
                }
                if (!isset($currentArray[$directory])) {
                    $currentArray[$directory] = [];
                }

                $currentArray = &$currentArray[$directory];
            }
            $currentArray[] = $file;

        }
        return new ParsedData($parsedData);
    }

    /**
     * @throws FileServiceFetchException
     */
    public function fetchData(): array
    {
        $response = Http::get($this->fileUrl);
        if ($response->failed()) {
            throw new FileServiceFetchException("Failed to fetch data.", 500);
        }
        return $response->json();
    }


}
