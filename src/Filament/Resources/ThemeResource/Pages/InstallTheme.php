<?php

namespace Insyht\Larvelous\Filament\Resources\ThemeResource\Pages;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Insyht\Larvelous\Console\Commands\InstallPackage;
use Insyht\Larvelous\Filament\Resources\ThemeResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class InstallTheme extends CreateRecord
{
    protected static string $resource = ThemeResource::class;

    public function mount(): void
    {
        parent::mount();
        abort_unless(auth()->user()->hasRole('admin'), 403);
    }

    protected function handleRecordCreation(array $data): Model
    {
        $githubUrl = sprintf('git@github.com:%s.git', $data['github_url']);
        $splitGithubPart = explode('/', $data['github_url']);

        $this->validateUrl($splitGithubPart);

        $githubHttpUrl = sprintf(
            'https://github.com/%s/%s',
            $splitGithubPart[0],
            $splitGithubPart[1],
        );
        $themeMetaDataUrl = sprintf('%s/blob/master/theme.json?raw=true', $githubHttpUrl);
        $ch = curl_init($themeMetaDataUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->validateMetaDataExistence($httpCode);

        $metaData = json_decode($response, true);

        $this->validateMetaData($metaData);

        $data = [
            'name' => $metaData['name'],
            'path' => $metaData['path'],
            'namespace' => $metaData['namespace'],
            'blade_prefix' => $metaData['blade_prefix'],
            'github_url' => $githubUrl,
            'image' => $metaData['image'], // todo upload it to storage
            'active' => false,
            'author' => $metaData['author'],
        ];

        // Add the package to the codebase
        $success = Artisan::call(InstallPackage::class, ['uri' => $uri]);
        if (!$success) {
            // todo Handle this better :P
            die('Failed to install package');
        }

        $result = parent::handleRecordCreation($data);

        Log::info(sprintf('Installed theme %s in the themes table', $metaData['name']));

        if (class_exists(sprintf('%s\Console\InstallTheme', $metaData['namespace']))) {
            $success = Artisan::call(sprintf('%s\Console\InstallTheme', $metaData['namespace']));
            if (!$success) {
                Log::error(sprintf('Failed to run InstallTheme command for theme %s', $metaData['name']));
            } else {
                Log::info(sprintf('Ran InstallTheme command for theme %s', $metaData['name']));
            }
        } else {
            Log::info(sprintf('No InstallTheme command found for theme %s, continuing..', $metaData['name']));
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

    private function validateMetaData(mixed $metaData): void
    {
        if (
            !is_array($metaData) ||
            !array_key_exists('name', $metaData) ||
            !array_key_exists('path', $metaData) ||
            !array_key_exists('namespace', $metaData) ||
            !array_key_exists('image', $metaData) ||
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
