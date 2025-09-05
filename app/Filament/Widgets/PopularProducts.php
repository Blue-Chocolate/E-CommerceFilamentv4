<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class PopularProducts extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Product::query()
                    ->select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
                    ->join('order_items', 'order_items.product_id', '=', 'products.id')
                    ->groupBy('products.id')
                    ->orderByDesc('total_sold')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Product')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('usd', true),

                Tables\Columns\TextColumn::make('total_sold')
                    ->label('Units Sold')
                    ->sortable(),
            ])
            ->defaultPaginationPageOption(5);
    }
}
