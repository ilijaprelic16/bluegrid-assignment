<?php

namespace App\Jobs;

use App\Exceptions\FileServiceFetchException;
use App\Services\FileService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheFilesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private FileService $fileService;

    /**
     * Execute the job.
     * @throws FileServiceFetchException
     */
    public function handle(FileService $fileService): void
    {
        Log::info('Cache data job started.');
        $fileService->cacheData();

        // dispatch self as soon is caching is finished to reduce waiting time and most up-to-date data for user
        self::dispatch();
    }
}
