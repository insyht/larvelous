<?php

namespace Insyht\Larvelous\Filament\Resources\UserResource\Pages;

use Insyht\Larvelous\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function mount() : void
    {
        parent::mount();
        abort_unless(auth()->user()->hasRole('admin'), 403);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($this->data['password']);

        return $data;
    }

    protected function handleRecordCreation(array $data) : Model
    {
        $result = parent::handleRecordCreation($data);
        /** @var User $user */
        $user = User::where('name', $data['name'])->first();
        $user->assignRole($data['role']);

        return $result;
    }

    protected function afterCreate(): void
    {
        // Send verification mail
        event(new Registered($this->record));
    }
}
