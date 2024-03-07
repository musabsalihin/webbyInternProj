<?php

namespace App\Jobs;

use App\Mail\ReminderEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ProcessReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $users;
    public function __construct(Collection $users)
    {
        //
        $this->users = $users;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        foreach ($this->users as $user) {
            # code...
            Mail::to($user->email)->send(new ReminderEmail());
        }
    }
}
