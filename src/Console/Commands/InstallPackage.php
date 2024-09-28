<?php

namespace Insyht\Larvelous\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class InstallPackage extends Command
{
    protected $signature = 'larvelous:install-package {uri}';

    protected $description = 'Install a plugin or theme using Composer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $uri = $this->argument('uri');
        Log::info(sprintf('Installing plugin "%s"...', $uri));
        $success = true;
        $process = Process::path(base_path());
        $logPrefix = sprintf('Installing package %s: ', $uri);
        $result = $process->run(
            sprintf('composer require %s', $uri),
            function (string $type, string $buffer) use ($logPrefix, &$success) {
                if ($type === 'stderr') {
                    Log::error($logPrefix . $buffer);
                    $success = false;
                } else {
                    Log::info($logPrefix . $buffer);
                }
            }
        );
        if ($result->successful()) {
            Log::debug(
                sprintf(
                    'Successfully installed package %s. Only the migration remains',
                    $uri
                )
            );
            $this->callSilently('migrate');
        } else {
            Log::error(sprintf('Failed to install package %s: %s', $uri, $result->errorOutput()));
            $success = false;
        }

        return $success;
    }
}
