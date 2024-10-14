<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;

class ClosedProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:closed-project';

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
        Project::query()
            ->where('ends_at', '<=', now())
            ->update(['status' => 'closed']);
    }
}
