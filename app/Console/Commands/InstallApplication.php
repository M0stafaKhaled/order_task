<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the application by running necessary commands and tasks.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Installing the application...');

        $this->info('Generating application key...');
        $this->call('key:generate');

        $this->info('Running migrations...');
        $this->call('migrate');

        $this->info('Running seeders...');
        $this->call('db:seed');

        $this->info('Generating jwt secret...');
        $this->call('jwt:secret');

        $this->info('Application installed successfully.');
    }
}
