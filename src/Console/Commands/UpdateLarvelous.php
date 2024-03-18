<?php

namespace Insyht\Larvelous\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class UpdateLarvelous extends Command
{
    protected $signature = 'larvelous:update';

    protected $description = 'Update Larvelous';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Updating system...');
        $success = true;
        $process = Process::path(base_path());
        // todo Make a backup (database, composer.lock, all files in a zip?) first?
        $logPrefix = 'Updating system: ';
        $result = $process->run(
            'composer update insyht/larvelous',
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
            Log::debug('Successfully updated system. Only the migration remains');
            $this->callSilently('migrate');
        } else {
            Log::error(sprintf('Failed to update system: %s', $result->errorOutput()));
            $success = false;
        }

        return $success;
    }
}
