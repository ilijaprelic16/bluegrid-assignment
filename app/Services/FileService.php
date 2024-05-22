<?php

namespace App\Services;

use App\Exceptions\FileServiceFetchException;
use Illuminate\Support\Facades\Http;

class FileService
{
    public string $fileUrl;


    public function __construct()
    {
        $this->fileUrl = config('services.file_service.url');
    }

    public function parseData(array $data): array
    {
//        //TODO: validate data

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
        return $parsedData;
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
