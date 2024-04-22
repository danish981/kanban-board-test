<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Phase;

class TaskSeeder extends Seeder {
    public function run(): void {
        $phaseIds = Phase::whereNot('name', 'Completed')->get()->pluck('id')->toArray();
        $userIds = User::get()->pluck('id')->toArray();

        Task::truncate();

        for ($i = 1; $i <= 30; $i++) {
            Task::create([
                'name' => fake()->realText(120),
                'phase_id' => $phaseIds[random_int(0, count($phaseIds) - 1)],
                'user_id' => $userIds[random_int(0, count($userIds) - 1)],
            ]);
        }
    }
}
