<?php

namespace App\Jobs;

use App\Models\Job as MyJob;

class ExampleJob extends Job
{

    public $task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $job = MyJob::find($this->task['reference']);
            $job->status = MyJob::$status['run_success'];
            $job->save();
        } catch (\Exception $e) {
            $this->fail($e);
        }

    }

    public function fail($exception = null)
    {
        $job = MyJob::find($this->task['reference']);
        $job->status = MyJob::$status['run_failed'];
        $job->save();
    }
}
