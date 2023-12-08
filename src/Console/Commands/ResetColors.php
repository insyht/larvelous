<?php

namespace Insyht\Larvelous\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Process\Pipe;
use Illuminate\Support\Facades\Process;

class ResetColors extends Command
{
    protected $signature = 'larvelous:reset-colors';

    protected $description = 'Reset/reload the color variables in the SCSS';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Process::pipe(function (Pipe $pipe) {
            $pipe->path(__DIR__ . '/../../../')->command(['npm', 'run', 'build']);
            $pipe->path(public_path() . '/../')->command(['pwd']);
            $pipe->path(public_path() . '/../')->command(['php', 'artisan', 'vendor:publish', '--tag=insyht-larvelous', '--force']);
        }, function ($type, $output) {
            echo $output;
        });
    }
}
