<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;
use PHPStan\PhpDocParser\Ast\Type\ArrayShapeItemNode;

class GenerateHelperCode extends Command {
    protected $signature = 'helper';
    protected $description = 'Command description';

    public function handle() {

        \Artisan::call('ide-helper:generate');
        \Artisan::call('ide-helper:models');
        \Artisan::call('ide-helper:meta');

    }
}
