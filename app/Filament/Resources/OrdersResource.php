<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdersResource\Pages;
use App\Filament\Resources\OrdersResource\RelationManagers;
use App\Models\Clients;
use App\Models\Product; // Assuming there is a Products model
use App\Models\Orders;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationGroup = 'Shop';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $clients = Clients::all()->pluck('name', 'id');
        $products = Product::all()->pluck('name','id');
        $statusOptions = ['pending' => 'Pending', 'processing' => 'Processing', 'completed' => 'Completed', 'Canceled' => 'Canceled']; // Adjust this based on your actual status options

        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->required()
                    ->options($clients)
                    ->label('Select Client'),

                Forms\Components\Select::make('product_id')
                    ->required()
                    ->options($products)
                    ->label('Select Product'),

                Forms\Components\Select::make('status')
                    ->required()
                    ->options($statusOptions)
                    ->label('Select Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('client.name')
                ->label('Client Name')
                ->searchable(),
            Tables\Columns\TextColumn::make('client.city')
                ->searchable(),
            Tables\Columns\TextColumn::make('product.name')
                ->label('Product Name'),
            Tables\Columns\TextColumn::make('product.price')
                ->label('Order Price')
                ->numeric(),
            Tables\Columns\TextColumn::make('status')
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Timestamp'),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrders::route('/create'),
            'edit' => Pages\EditOrders::route('/{record}/edit'),
        ];
    }

    public function widgets()
    {
        return [
            OrdersOverview::make(),
            // Other widgets...
        ];
    }
}
