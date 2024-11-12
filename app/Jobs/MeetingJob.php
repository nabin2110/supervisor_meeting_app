<?php

namespace App\Jobs;

use App\Mail\MeetingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MeetingJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $meeting;
    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('meeting scheduled'.$this->meeting->meeting_time);
        Mail::to('razutimalsina123@gmail.com')->send(new MeetingMail($this->meeting));
    }
}
