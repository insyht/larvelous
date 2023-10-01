<?php

namespace Insyht\Larvelous\Filament\Resources;

use Insyht\Larvelous\Filament\Resources\UserResource\Pages;
use Insyht\Larvelous\Filament\Resources\UserResource\RelationManagers;
use Insyht\Larvelous\Forms\Components\Dropdown;
use Insyht\Larvelous\Forms\Components\TextInput;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('insyht-larvelous::cms.name')),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label(__('insyht-larvelous::cms.emailAddress')),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->label(__('insyht-larvelous::cms.password'))
                    ->autocomplete('new-password'),
                Dropdown::make('role')->required()->options(Role::all()->pluck('name', 'id'))->label(__('insyht-larvelous::cms.role')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('insyht-larvelous::cms.name')),
                TextColumn::make('email')->label(__('insyht-larvelous::cms.emailAddress')),
                IconColumn::make('email_verified_at')
                          ->options([
                            'heroicon-o-check-circle',
                            'heroicon-o-x-circle' => null
                          ])->colors([
                              'success',
                              'danger' => null
                          ])->label(__('insyht-larvelous::cms.emailVerified')),
                TextColumn::make('roles')->label(__('insyht-larvelous::cms.role'))->getStateUsing(function (Model $record) {
                    // Technically, a user can have multiple roles, but we limit it to 1
                    return $record->roles()->first()?->name;
                })
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                          ->mutateRecordDataUsing(function (array $data): array {
                              $data['role'] = User::find($data['id'])->roles()->first()->id;
                              $data['password'] = '';

                              return $data;
                          })->form([
                              TextInput::make('name')
                                       ->required()
                                       ->maxLength(255)
                                       ->label(__('insyht-larvelous::cms.name')),
                              TextInput::make('email')
                                       ->email()
                                       ->required()
                                       ->maxLength(255)
                                       ->label(__('insyht-larvelous::cms.emailAddress')),
                              TextInput::make('password')
                                       ->password()
                                       ->maxLength(255)
                                       ->label(__('insyht-larvelous::cms.password'))
                                       ->autocomplete('new-password')->hint(__('insyht-larvelous::cms.passwordOnlyOnChange')),
                              Dropdown::make('role')->required()->options(Role::all()->pluck('name', 'id'))->label(__('insyht-larvelous::cms.role'))
                          ])->using(function (Model $record, array $data): Model {
                                $newPassword = $data['password'];
                                if ($newPassword === null) {
                                    $data['password'] = $record->password;
                                } else {
                                    $data['password'] = Hash::make($data['password']);
                                }
                              $record->update($data);

                              return $record;
                          }),
                DeleteAction::make()->before(function (DeleteAction $action) {
                    if ($action->getRecord()->name === 'IWS') {
                        Notification::make()->warning()->body(__('insyht-larvelous::cms.errors.deleteIwsAccountNotAllowed'))->send();
                        $action->halt();
                    }
                }),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('Admin');
    }

    public static function getEloquentQuery() : \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->whereNot('name', 'IWS');
    }
}
