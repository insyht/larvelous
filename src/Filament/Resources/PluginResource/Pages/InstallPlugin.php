<?php

namespace Insyht\Larvelous\Filament\Resources\PluginResource\Pages;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Insyht\Larvelous\Filament\Resources\PluginResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Insyht\Larvelous\Helpers\PackageHelper;

class InstallPlugin extends CreateRecord
{
    protected static string $resource = PluginResource::class;

    public function mount() : void
    {
        parent::mount();
        abort_unless(auth()->user()->hasRole('admin'), 403);
    }

    protected function handleRecordCreation(array $data) : Model
    {
        $githubUrl = sprintf('git@github.com:%s.git', $data['github_url']);
        $splitGithubPart = explode('/', $data['github_url']);

        $this->validateUrl($splitGithubPart);

        $githubHttpUrl = sprintf(
            'https://github.com/%s/%s',
            $splitGithubPart[0],
            $splitGithubPart[1],
        );
        $pluginMetaDataUrl = sprintf('%s/blob/master/plugin.json?raw=true', $githubHttpUrl);
        $ch = curl_init($pluginMetaDataUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->validateMetaDataExistence($httpCode);

        $metaData = json_decode($response, true);

        $this->validateMetaData($metaData);

        $data = [
            'base' => $metaData['base'],
            'name' => $metaData['name'],
            'path' => $metaData['path'],
            'namespace' => $metaData['namespace'],
            'github_url' => $githubUrl,
            'active' => true,
            'author' => $metaData['author'],
        ];

        $result = parent::handleRecordCreation($data);

        Log::info(sprintf('Installed plugin %s in the plugins table', $metaData['name']));

        if (class_exists(sprintf('%s\Console\InstallPlugin', $metaData['namespace']))) {
            $success = Artisan::call(sprintf('%s\Console\InstallPlugin', $metaData['namespace']));
            if (!$success) {
                Log::error(sprintf('Failed to run InstallPlugin command for plugin %s', $metaData['name']));
            } else {
                Log::info(sprintf('Ran InstallPlugin command for plugin %s', $metaData['name']));
            }
        } else {
            Log::info(sprintf('No InstallPlugin command found for plugin %s, continuing..', $metaData['name']));
        }

        return $result;
    }

    private function validateUrl(array $splitGithubPart): void
    {
        if (count($splitGithubPart) !== 2) {
            Notification::make()
                        ->warning()
                        ->title(__('insyht-larvelous::cms.invalidGithubUrlNotificationTitle'))
                        ->body(__('insyht-larvelous::cms.invalidGithubUrlNotificationBody'))
                        ->send();
            $this->halt();
        }
    }

    private function validateMetaDataExistence(int $httpCode): void
    {
        if ($httpCode !== 200) {
            Notification::make()
                        ->warning()
                        ->title(__('insyht-larvelous::cms.invalidGithubUrlNotificationTitle'))
                        ->body(__('insyht-larvelous::cms.invalidGithubUrlNotificationBody'))
                        ->send();
            $this->halt();
        }
    }

    private function validateMetaData($metaData): void
    {
        if (
            !is_array($metaData) ||
            !array_key_exists('base', $metaData) ||
            !array_key_exists('name', $metaData) ||
            !array_key_exists('path', $metaData) ||
            !array_key_exists('namespace', $metaData) ||
            !array_key_exists('author', $metaData)
        ) {
            Notification::make()
                        ->warning()
                        ->title(__('insyht-larvelous::cms.invalidPluginTitle'))
                        ->body(__('insyht-larvelous::cms.invalidPluginBody'))
                        ->send();
            $this->halt();
        }
    }
}
