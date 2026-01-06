<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenggunaanPakanResource\Pages;
use App\Models\PenggunaanPakan;
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

class PenggunaanPakanResource extends Resource
{
    protected static ?string $model = PenggunaanPakan::class;

    protected static ?string $navigationIcon = 'heroicon-o-refresh';
    protected static ?string $navigationLabel = 'Penggunaan Pakan';
    protected static ?string $navigationGroup = 'Transactions'; // Grup menu
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pakan_id')
                    ->label('Pakan')
                    ->relationship('pakan', 'nama_pakan')
                    ->required(),

                Select::make('kolam_id')
                    ->label('Kolam')
                    ->relationship('kolam', 'nama_kolam')
                    ->required(),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),

                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal Penggunaan')
                    ->required(),

                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->default(fn () => auth()->id())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pakan.nama_pakan')
                    ->label('Nama Pakan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kolam.nama_kolam')
                    ->label('Nama Kolam')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah Pakan')
                    ->sortable(),

                TextColumn::make('tanggal')
                    ->label('Tanggal Penggunaan')
                    ->dateTime()
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
            // Jika ada relasi lain, bisa ditambahkan di sini
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenggunaanPakans::route('/'),
            'create' => Pages\CreatePenggunaanPakan::route('/create'),
            'edit' => Pages\EditPenggunaanPakan::route('/{record}/edit'),
        ];
    }
}
