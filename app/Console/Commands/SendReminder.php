<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Todo; // Example of a model you might use
use Auth;
use App\Notifications\ReminderNotification; // Example of a notification you might use

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send {userId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder notifications to users';

    // Execute the console command.
    public function handle()
    {
       $userId = $this->argument('userId');
      
        $users = Todo::where(['created_by' => $userId])->orderBy('created_at','desc')->whereDate('start', now()->format('Y-m-d'))->where(['reminder' => 1, 'is_read' => 0])->where('time', '<=', now()->format('H:i'))->get(); // Example query
        foreach ($users as $user) {
            $user->notify(new ReminderNotification());
        }
        $this->info('Reminders have been sent successfully!');
    }
}
