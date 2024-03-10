<?php

namespace Insyht\Larvelous\Filament\Resources;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Insyht\Larvelous\Filament\Resources\PluginResource\Pages;
use Insyht\Larvelous\Forms\Components\TextInput;
use Insyht\Larvelous\Helpers\LarvelousHelper;
use Insyht\Larvelous\Models\Plugin;

class PluginResource extends Resource
{
    protected static ?string $model = Plugin::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('github_url')
                         ->required()
                         ->label(__('insyht-larvelous::cms.githubUrl'))
                         ->prefix('git@github.com:')
                         ->suffix('.git'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                          ->label(__('insyht-larvelous::cms.name'))
                          ->sortable()
                          ->searchable(isIndividual: true),
                TextColumn::make('author')
                          ->label(__('insyht-larvelous::cms.author'))
                          ->sortable(),
                IconColumn::make('active')
                          ->boolean()
                          ->label(__('insyht-larvelous::cms.active'))
                          ->sortable(),
                IconColumn::make('update')
                          ->boolean()
                          ->label(__('insyht-larvelous::cms.updateAvailable'))
                          ->sortable()
                          ->getStateUsing(function (Model $record): bool {
                              $updateablePackages = app(LarvelousHelper::class)->getUpdateablePackageNames();

                              return in_array($record->path, array_column($updateablePackages, 'name'));
                          })
                          ->tooltip(function (Model $record): string {
                              $updateablePackages = app(LarvelousHelper::class)->getUpdateablePackageNames();
                              $label = '';
                              $packageIsUpdateable = in_array($record->path, array_column($updateablePackages, 'name'));
                              if ($packageIsUpdateable) {
                                  $package = array_filter($updateablePackages, function ($package) use ($record) {
                                      return $package['name'] === $record->path;
                                  });
                                  if (isset($package[0])) {
                                    $label = $package[0]['current']  . ' -> ' . $package[0]['latest'];
                                  }
                              }

                              return $label;
                          })
            ])
            ->filters([])
            ->actions([
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlugins::route('/'),
            'create' => Pages\InstallPlugin::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }


    public static function getModelLabel(): string
    {
        return __('insyht-larvelous::cms.plugin');
    }

    public static function getPluralModelLabel(): string
    {
        return __('insyht-larvelous::cms.plugins');
    }
}
