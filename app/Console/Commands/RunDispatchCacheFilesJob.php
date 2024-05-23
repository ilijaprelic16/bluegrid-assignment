<?php

namespace App\Console\Commands;

use App\Jobs\CacheFilesJob;
use Illuminate\Console\Command;

class RunDispatchCacheFilesJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-cache-files-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches first job for caching files';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        dispatch(new CacheFilesJob());
    }
}
