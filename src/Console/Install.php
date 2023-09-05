<?php

namespace Insyht\Larvelous\Console;

use Illuminate\Console\Command;

class Install extends Command
{
    protected $hidden = true;
    protected $signature = 'insyht-larvelous:install';
    protected $description = 'Install the Larvelous Framework';

    public function handle()
    {
        $this->info('Installing Larvelous...');

        $this->info('Publishing configuration...');
        $this->publishConfiguration(true);

        $this->info('Installed Larvelous!');
    }

    protected function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Insyht\Larvelous\LarvelousServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
