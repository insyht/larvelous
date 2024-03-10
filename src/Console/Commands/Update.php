<?php

namespace Insyht\Larvelous\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Insyht\Larvelous\Helpers\LarvelousHelper;

class Update extends Command
{
    protected $signature = 'larvelous:update';

    protected $description = 'Update Larvelous and all currently installed plugins';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Updating system...');
        $success = true;
        $updateablePackages = app(LarvelousHelper::class)->getUpdateablePackageNames(false);
        Log::info(sprintf('Found %d updateable packages', count($updateablePackages)));
        $process = Process::path(base_path());
        // todo Make a backup (database, composer.lock, all files in a zip?) first?
        foreach ($updateablePackages as $package) {
            $logPrefix = sprintf('Updating package %s: ', $package['name']);
            $result = $process->run(
                sprintf('composer update %s', $package['name']),
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
                $a = $result->output();
                $this->callSilently('migrate');
            } else {
                $a = $result->errorOutput();
                $success = false;
            }
        }
        Cache::forget('updateablePackages');

        return $success;
    }
}
