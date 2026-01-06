<?php

namespace App\Filament\Resources\PembelianPakanResource\Pages;

use App\Filament\Resources\PembelianPakanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembelianPakan extends EditRecord
{
    protected static string $resource = PembelianPakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
