<?php

namespace App\Console\Commands;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch bills that are not cleared and have a reminder time set
        $bills = Bill::where('is_cleared', false)
                    ->whereNotNull('next_reminder_at')
                    ->get();

        // Initialize a variable to store the cron jobs
        $cronJobs = "";

        foreach ($bills as $bill) {
            // Format the reminder time into cron format (minute, hour, day, month, weekday)
            $time = $bill->next_reminder_at->format('i H d m *');

            // Build the cron job command for each bill
            $cronJobs .= "$time cd /PracticeFolder/CronJobPractice/ && php artisan bill:sendReminder {$bill->id} >> /dev/null 2>&1\n";
        }

        // Update the crontab with the generated jobs
        $this->updateCrontab($cronJobs);

        $this->info('Crontab has been updated with new jobs.');
    }

    // Helper function to update the crontab with the generated jobs
    protected function updateCrontab($jobs)
    {
        // Clear the current crontab, keeping only system-wide cron jobs
        exec('crontab -l | grep -v "/path-to-your-laravel-project" > /tmp/current-cron');

        // Add new jobs to the current crontab file
        file_put_contents('/tmp/laravel-cron', $jobs, FILE_APPEND);

        // Install the updated crontab file
        exec('crontab /tmp/laravel-cron');
    }
}
