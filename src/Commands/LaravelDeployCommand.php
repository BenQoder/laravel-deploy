<?php

namespace BenQoder\LaravelDeploy\Commands;

use Illuminate\Console\Command;

class LaravelDeployCommand extends Command
{
    public $signature = 'laravel-deploy';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
