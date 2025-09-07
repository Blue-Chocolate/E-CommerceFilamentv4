<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Products\Pages;
use App\Models\Product;
use App\Services\AnalyticsService;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use BackedEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $recordTitleAttribute = 'name';

    /**
     * Define the form schema for creating/editing products.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('image')
                ->image()
                ->directory('products') // stores in storage/app/public/products
                ->imageEditor() // optional: enables cropping/resizing in UI
                ->required(),

            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->required(),

            Forms\Components\Textarea::make('description')
                ->nullable()
                ->maxLength(1000),
        ]);
    }

    /**
     * Define the table view for products.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->square()
                    ->size(60)
                    ->label('Photo'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->money('usd')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    /**
     * Example of fetching top-selling products (for widgets or dashboards).
     */
    public static function getTopProducts(): \Illuminate\Support\Collection
    {
        return AnalyticsService::getTopSellingProducts();
    }

    /**
     * Register resource pages.
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
