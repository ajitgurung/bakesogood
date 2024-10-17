<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\ModelHelper;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
    // protected static string $view = 'filament.resources.order-resource.pages.custom-order';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['order_number'] = ModelHelper::get_order_number();

        return $data;
    }
}
