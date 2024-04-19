<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ResetDBandSeed extends Command {

    protected $signature = 'db:reset';
    protected $description = 'reset and re-seed the datatabase';

    public function handle() {

        Artisan::call('db:wipe');
        Artisan::call('migrate');
        Artisan::call('db:seed');

    }
}
