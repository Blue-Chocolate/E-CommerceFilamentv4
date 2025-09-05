<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class TopCustomers extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Customer::query()
                    ->select('customers.*', DB::raw('SUM(orders.total) as total_spent'))
                    ->join('orders', 'orders.customer_id', '=', 'customers.id')
                    ->groupBy('customers.id')
                    ->orderByDesc('total_spent')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_spent')
                    ->label('Total Spent')
                    ->money('usd', true) // format as money
                    ->sortable(),
            ])
            ->defaultPaginationPageOption(5);
    }
}
