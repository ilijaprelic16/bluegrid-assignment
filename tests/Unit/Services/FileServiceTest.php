<?php

namespace Tests\Unit\Services;

use App\Exceptions\FileServiceFetchException;
use App\Services\FileService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FileServiceTest extends TestCase
{
    private FileService $fileService;

    private array $sampleData;

    public function setUp(): void
    {
        parent::setUp();
        $this->fileService = app(FileService::class);
        $this->sampleData = [
            'items' => [

                [
                    'fileUrl' => "34.8.32.234:48183/SvnRep/ADV-H5-New/README.txt"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/SvnRep/ADV-H5-New/VisualSVN.lck"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/SvnRep/ADV-H5-New/hooks-env.tmpl"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/SvnRep/AT-APP/README.txt"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/SvnRep/AT-APP/VisualSVN.lck"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/SvnRep/AT-APP/hooks-env.tmpl"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/SvnRep/README.txt"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/SvnRep/VisualSVN.lck"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/SvnRep/hooks-env.tmpl"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/www/README.txt"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/www/VisualSVN.lck"
                ],
                [
                    'fileUrl' => "34.8.32.234:48183/www/hooks-env.tmpl"
                ]
            ],
        ];
        $this->sampleResult = [
            "34.8.32.234" => [
                "SvnRep" => [
                    "ADV-H5-New" => [
                        "README.txt" => ["README.txt"],
                        "VisualSVN.lck" => ["VisualSVN.lck"],
                        "hooks-env.tmpl" => ["hooks-env.tmpl"]
                    ],
                    "AT-APP" => [
                        "README.txt" => ["README.txt"],
                        "VisualSVN.lck" => ["VisualSVN.lck"],
                        "hooks-env.tmpl" => ["hooks-env.tmpl"]
                    ],
                    "README.txt" => ["README.txt"],
                    "VisualSVN.lck" => ["VisualSVN.lck"],
                    "hooks-env.tmpl" => ["hooks-env.tmpl"]
                ],
                "www" => [
                    "README.txt" => ["README.txt"],
                    "VisualSVN.lck" => ["VisualSVN.lck"],
                    "hooks-env.tmpl" => ["hooks-env.tmpl"]
                ]
            ]
        ];
    }

    public function test_parse_data()
    {
        $result = $this->fileService->parseData($this->sampleData);
        $this->assertEquals($result->getData(), $this->sampleResult);

    }

    /**
     * A basic test example.
     * @throws FileServiceFetchException
     */
    public function test_fetch_data(): void
    {
        Http::fake([
            $this->fileService->fileUrl => Http::response($this->sampleData)
        ]);
        $data = $this->fileService->fetchData();
        $this->assertEquals($this->sampleData, $data);
    }

    /**
     * @throws FileServiceFetchException
     */
    public function test_cache_files()
    {
        Http::fake([
            $this->fileService->fileUrl => Http::response($this->sampleData)
        ]);
        $this->fileService->cacheData();
        $this->assertTrue($this->fileService->hasCache());
    }
}
