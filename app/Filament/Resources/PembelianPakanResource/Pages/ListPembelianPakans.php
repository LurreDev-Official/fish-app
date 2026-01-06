<?php

namespace App\Filament\Resources\PembelianPakanResource\Pages;

use App\Filament\Resources\PembelianPakanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembelianPakans extends ListRecords
{
    protected static string $resource = PembelianPakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
