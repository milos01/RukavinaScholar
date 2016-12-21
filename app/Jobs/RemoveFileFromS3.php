<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveFileFromS3 extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $fileName;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fileName)
    {
         $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $s3 = Storage::disk('s3');
        $s3->delete($this->fileName);
    }
}
