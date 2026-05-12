<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete-unverified';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete users who have not verified their email after 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereNull('email_verified_at')
            ->where('created_at', '<=', now()->subHours(24))
            ->get();

        foreach ($users as $user) {

            // Delete verification record if exists
            if ($user->verification) {
                $user->verification->delete();
            }

            // Delete user
            // $user->delete();
            $user->forceDelete();
        }

        $this->info('Unverified users deleted successfully.');

        return Command::SUCCESS;
    }
}