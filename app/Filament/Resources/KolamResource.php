<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KolamResource\Pages;
use App\Filament\Resources\KolamResource\RelationManagers;
use App\Models\Kolam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DateTimePicker;

class KolamResource extends Resource
{
    protected static ?string $model = Kolam::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';
    protected static ?string $navigationLabel = 'Kolam Ikan';
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
                Forms\Components\TextInput::make('nama_kolam')
                    ->label('Nama Kolam')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('jenis_ikan')
                    ->label('Jenis Ikan')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('kapasitas')
                    ->label('Kapasitas (jumlah ikan)')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal'),
                Forms\Components\TextInput::make('lokasi')
                    ->label('Lokasi')
                    ->required()
                    ->maxLength(100),
                Forms\Components\DateTimePicker::make('tanggal_dibuat')
    ->label('Tanggal Dibuat')
    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kolam_id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_kolam')
                    ->label('Nama Kolam')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_ikan')
                    ->label('Jenis Ikan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_dibuat')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListKolams::route('/'),
            'create' => Pages\CreateKolam::route('/create'),
            'edit' => Pages\EditKolam::route('/{record}/edit'),
        ];
    }
}
