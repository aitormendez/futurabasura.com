<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ListProviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:list-providers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all registered service providers in Acorn';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $providers = array_keys(app()->getLoadedProviders());

        if (empty($providers)) {
            $this->warn('No service providers found.');
            return;
        }

        $this->info('Registered Service Providers:');
        foreach ($providers as $provider) {
            $this->line(' - ' . $provider);
        }
    }
}
