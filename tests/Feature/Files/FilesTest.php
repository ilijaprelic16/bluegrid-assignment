<?php

namespace Feature\Files;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FilesTest extends TestCase
{
    private string $dataUrl;
    private array $sampleData;
    private array $sampleResult;

    public function setUp(): void
    {
        parent::setUp();
        $this->dataUrl = config('services.file_service.url');
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
    const  ROUTE = 'api/files';
    /**
     * A basic test example.
     */
    public function test_files(): void
    {
        Http::fake([
            $this->dataUrl => Http::response($this->sampleData)
        ]);
        $response = $this->getJson(self::ROUTE);
        $response->assertStatus(200);
        $this->assertEquals($this->sampleResult, $response->json('data'));
    }
}
