<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Resources\FileIndexResource;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(
        private FileService $fileService
    )
    {
    }

    public function index(): FileIndexResource
    {
        $response = $this->fileService->getData();
        return FileIndexResource::make($response);
    }
}
