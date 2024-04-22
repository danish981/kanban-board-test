<?php

namespace App\Console\Commands;

use App\Models\Phase;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RandomizeTasks extends Command {

    protected $signature = 'tasks:randomize';
    protected $description = 'Command description';

    public function handle() {

        $tasks = Task::get();
        $now = now();
        $currentDay = $now->day;

        $this->withProgressBar($tasks, function ($task) use ($now, $currentDay) {
            $randomDay = $now->firstOfMonth()->addDays(random_int(1, $currentDay-1))->format('Y-m-d H:i:s');
            $task->phase_id = Phase::whereName('Completed')->first()->id;
            $task->completed_at = $randomDay;
            $task->save();
        });

        foreach ($tasks as $task) {
            $this->line($task->completed_at . ' (' .  Carbon::parse($task->completed_at)->diffForHumans() . ')');
        }
    }
}

