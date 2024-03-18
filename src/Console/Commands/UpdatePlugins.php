<?php

namespace Insyht\Larvelous\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Insyht\Larvelous\Helpers\PackageHelper;

class UpdatePlugins extends Command
{
    protected $signature = 'larvelous:update-plugins';

    protected $description = 'Update all currently installed plugins';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Updating plugins...');
        $success = true;
        $updateablePackages = app(PackageHelper::class)->getUpdateablePackageNamesForPlugins(false);
        Log::info(sprintf('Found %d updateable plugin packages', count($updateablePackages)));
        $process = Process::path(base_path());
        // todo Make a backup (database, composer.lock, all files in a zip?) first?
        foreach ($updateablePackages as $package) {
            $logPrefix = sprintf('Updating plugin package %s: ', $package['name']);
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
                        'Successfully updated plugin package %s. Only the migration remains',
                        $package['name']
                    )
                );
                $this->callSilently('migrate');
            } else {
                Log::error(sprintf('Failed to update plugin package %s: %s', $package['name'], $result->errorOutput()));
                $success = false;
            }
        }
        Cache::forget('updateablePackages');

        return $success;
    }
}
