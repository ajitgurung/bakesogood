<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        $user = $this->record;
        if(auth()->user()->id != $user->id){
            return [
                Actions\DeleteAction::make(),
            ];
        }

        return [];
    }
}
