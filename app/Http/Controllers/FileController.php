<?php

namespace App\Http\Controllers;

use App\Exceptions\FileServiceFetchException;
use App\Http\Resources\FileIndexResource;
use App\Services\FileService;

class FileController extends Controller
{
    public function __construct(
        private readonly FileService $fileService
    )
    {
    }

    /**
     * @throws FileServiceFetchException
     */
    public function index(): FileIndexResource
    {
        $response = $this->fileService->getData();
        return FileIndexResource::make($response);
    }
}
