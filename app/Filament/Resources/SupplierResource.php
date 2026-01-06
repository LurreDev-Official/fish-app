<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Supplier';
    protected static ?string $navigationGroup = 'Collections';
    protected static ?int $navigationSort = 2;
    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form for creating/updating a supplier
                Forms\Components\TextInput::make('nama_supplier')
                    ->label('Nama Supplier')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('kontak')
                    ->label('Kontak')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextArea::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_supplier')
                    ->label('Nama Supplier')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kontak')
                    ->label('Kontak')
                    ->sortable(),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50)  // Menampilkan hanya sebagian alamat di tabel
                    ->sortable(),
            ])
            ->filters([
                // Add filters here if needed
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // If there are relationships, add them here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
