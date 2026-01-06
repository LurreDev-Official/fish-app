<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PakanResource\Pages;
use App\Models\Pakan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class PakanResource extends Resource
{
    protected static ?string $model = Pakan::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pakan';
    protected static ?string $navigationGroup = 'Collections'; // Grup navigasi yang sama dengan Post
    protected static ?int $navigationSort = 0;
public static function getNavigationBadge(): ?string
{
    return (string) static::getModel()::count();
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pakan')
                    ->label('Nama Pakan')
                    ->required()
                    ->maxLength(100),

                Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'pelet' => 'Pelet',
                        'alami' => 'Alami',
                    ])
                    ->required()
                    ->native(false)
                    ->searchable(),

                Select::make('satuan')
                    ->label('Satuan')
                    ->options([
                        'kg' => 'Kilogram (kg)',
                        'gram' => 'Gram (g)',
                        'liter' => 'Liter',
                        'pcs' => 'Pcs',
                    ])
                    ->required()
                    ->native(false),

                Forms\Components\TextInput::make('harga_per_kg')
                    ->label('Harga per Kg')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal')
                    ->prefix('Rp'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('nama_pakan')
                    ->label('Nama Pakan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->sortable(),

                TextColumn::make('satuan')
                    ->label('Satuan')
                    ->sortable(),

                TextColumn::make('harga_per_kg')
                    ->label('Harga per Kg')
                    ->money('IDR')
                    ->sortable(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPakans::route('/'),
            'create' => Pages\CreatePakan::route('/create'),
            'edit' => Pages\EditPakan::route('/{record}/edit'),
        ];
    }
}
