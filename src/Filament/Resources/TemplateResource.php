<?php

namespace Insyht\Larvelous\Filament\Resources;

use Insyht\Larvelous\Filament\Resources\TemplateResource\Pages\CreateTemplate;
use Insyht\Larvelous\Filament\Resources\TemplateResource\Pages\EditTemplate;
use Insyht\Larvelous\Filament\Resources\TemplateResource\Pages\ListTemplates;
use Insyht\Larvelous\Filament\Resources\TemplateResource\Pages\ViewTemplate;
use Insyht\Larvelous\Filament\Resources\TemplateResource\RelationManagers\BlocksRelationManager;
use Insyht\Larvelous\Forms\Components\TextInput;
use Insyht\Larvelous\Models\Template;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;

class TemplateResource extends Resource
{
    protected static ?string $model = Template::class;

    protected static ?string $navigationIcon = 'heroicon-o-template';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('resource_id')
                    ->required()
                    ->maxLength(100)
                    ->label(__('insyht-larvelous::cms.resourceId')),
                TextInput::make('label')
                    ->required()
                    ->maxLength(100)
                    ->label(__('insyht-larvelous::cms.label')),
                TextInput::make('view')
                    ->required()
                    ->maxLength(100)
                    ->default('base')
                    ->label(__('insyht-larvelous::cms.templateView')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('resource_id'),
                TextColumn::make('label'),
                TextColumn::make('view'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            BlocksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTemplates::route('/'),
            'create' => CreateTemplate::route('/create'),
            'view' => ViewTemplate::route('/{record}'),
            'edit' => EditTemplate::route('/{record}/edit'),
        ];
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('Admin');
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->hasRole('Admin'), 403);
    }
}
