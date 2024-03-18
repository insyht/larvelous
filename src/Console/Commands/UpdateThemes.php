<?php

namespace Insyht\Larvelous\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Insyht\Larvelous\Helpers\PackageHelper;

class UpdateThemes extends Command
{
    protected $signature = 'larvelous:update-themes';

    protected $description = 'Update all currently installed themes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Updating themes...');
        $success = true;
        $updateablePackages = app(PackageHelper::class)->getUpdateablePackageNamesForThemes(false);
        Log::info(sprintf('Found %d updateable theme packages', count($updateablePackages)));
        $process = Process::path(base_path());
        // todo Make a backup (database, composer.lock, all files in a zip?) first?
        foreach ($updateablePackages as $package) {
            $logPrefix = sprintf('Updating theme package %s: ', $package['name']);
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
                Log::debug(
                    sprintf(
                        'Successfully updated theme package %s. Only the migration remains',
                        $package['name']
                    )
                );
                $this->callSilently('migrate');
            } else {
                Log::error(sprintf('Failed to update theme package %s: %s', $package['name'], $result->errorOutput()));
                $success = false;
            }
        }
        Cache::forget('updateablePackages');

        return $success;
    }
}
