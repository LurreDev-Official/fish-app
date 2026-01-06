<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembelianPakanResource\Pages;
use App\Models\PembelianPakan;
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

class PembelianPakanResource extends Resource
{
    protected static ?string $model = PembelianPakan::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Pembelian Pakan';
    protected static ?string $navigationGroup = 'Transactions'; // Grup menu
    protected static ?int $navigationSort = 2;

    // public static function getNavigationBadge(): ?string
    // {
    //     return number_format(static::getModel()::count());
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form untuk pembelian pakan
                Select::make('pakan_id')
                    ->label('Pakan')
                    ->relationship('pakan', 'nama_pakan') // Relasi ke tabel Pakan
                    ->required(),

                Select::make('supplier_id')
                    ->label('Supplier')
                    ->relationship('supplier', 'nama_supplier') // Relasi ke tabel Supplier
                    ->required(),

                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('harga_satuan')
                    ->label('Harga per Satuan')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->disabled()
                    ->default(function (Get $get) {
                        return $get('jumlah') * $get('harga_satuan');
                    }),

                Forms\Components\DatePicker::make('tanggal_pembelian')
                    ->label('Tanggal Pembelian')
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

                TextColumn::make('supplier.nama_supplier')
                    ->label('Supplier')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->sortable(),

                TextColumn::make('harga_satuan')
                    ->label('Harga per Satuan')
                    ->sortable()
                    ->money('IDR'),

                TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('tanggal_pembelian')
                    ->label('Tanggal Pembelian')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Filter jika diperlukan
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
            'index' => Pages\ListPembelianPakans::route('/'),
            'create' => Pages\CreatePembelianPakan::route('/create'),
            'edit' => Pages\EditPembelianPakan::route('/{record}/edit'),
        ];
    }
}
