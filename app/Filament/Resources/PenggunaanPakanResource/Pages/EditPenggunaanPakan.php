<?php

namespace App\Filament\Resources\PenggunaanPakanResource\Pages;

use App\Filament\Resources\PenggunaanPakanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenggunaanPakan extends EditRecord
{
    protected static string $resource = PenggunaanPakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
