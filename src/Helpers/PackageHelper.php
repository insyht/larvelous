<?php

namespace Insyht\Larvelous\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Process;
use Insyht\Larvelous\Models\Plugin;
use Insyht\Larvelous\Models\Theme;

class PackageHelper
{
    public function getComposerPackageNames(): array
    {
        $packageNames = [
            'insyht/larvelous',
        ];
        return array_merge(
            $packageNames,
            $this->extractComposerPackageNames(array_values(Plugin::all()->pluck('github_url')->toArray())),
            $this->extractComposerPackageNames(array_values(Theme::all()->pluck('github_url')->toArray()))
        );
    }

    public function getUpdateablePackageNames(bool $useCache = true): array
    {
        if (!$useCache) {
            return $this->getUpdateablesFromComposer();
        }

        $cachedUpdateablePackageNames = Cache::get('updateablePackages');
        if ($cachedUpdateablePackageNames === null) {
            Cache::put('updateablePackages', $this->getUpdateablesFromComposer(), 60*10);
            $cachedUpdateablePackageNames = Cache::get('updateablePackages');
        }

        return $cachedUpdateablePackageNames;
    }

    protected function getUpdateablesFromComposer(): array
    {
        $packageNames = $this->getComposerPackageNames();
        $updateablePackageNames = [];

        $result = Process::path(base_path())->run('composer outdated --format json');
        $output = $result->output();
        $outdatedPackages = json_decode($output, true);
        if (is_array($outdatedPackages) && !empty($outdatedPackages['installed'])) {
            foreach ($outdatedPackages['installed'] as $outdatedPackage) {
                if (!in_array($outdatedPackage['name'], $packageNames) || $outdatedPackage['direct-dependency'] === false) {
                    // todo Maybe also update packages that are not in $packageNames, like laravel itself?
                    continue;
                }
                if ($outdatedPackage['latest-status'] === 'up-to-date') {
                    continue;
                }
                if ($outdatedPackage['latest-status'] === 'update-possible') {
                    // This is a major version update, so ignore for now
                    continue;
                }
                $updateablePackageNames[] = [
                    'name' => $outdatedPackage['name'],
                    'current' => $outdatedPackage['version'],
                    'latest' => $outdatedPackage['latest'],
                ];
            }
        }

        return $updateablePackageNames;
    }

    protected function extractComposerPackageNames(array $urls): array
    {
        $extractedUrls = array_map(function (string $url) {
            return str_replace(['git@github.com:', '.git'], '', $url);
        }, $urls);

        return array_filter($extractedUrls, function (string $url) {
            return $url !== '';
        });
    }

    public function getCurrentPackageVersion(string $name): string
    {
        $version = '';
        $composerLockFilePath = sprintf('%s/composer.lock', base_path());
        $composerLockJson = json_decode(file_get_contents($composerLockFilePath), true);
        $package = array_filter($composerLockJson['packages'], function ($package) use ($name) {
            return $package['name'] === $name;
        });

        if (is_array($package) && !empty($package)) {
            $package = array_values($package);
            $version = $package[0]['version'];
        }
        return $version;
    }

    public function deletePackage(string $name): bool
    {
        $success = false;

        if ($name !== 'insyht/larvelous') {
            Process::path(base_path())->run(sprintf('composer remove %s', $name));

            $composerJsonPath = sprintf('%s/composer.json', base_path());
            $composerArray = json_decode(file_get_contents($composerJsonPath), true);
            $success = !empty($composerArray['require']) && !array_key_exists($name, $composerArray['require']);
        }

        return $success;
    }
}
