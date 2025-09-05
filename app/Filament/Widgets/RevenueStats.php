<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueStats extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $totalOrders = Order::where('status', 'completed')->count();
        $averageOrder = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        return [
            Stat::make('Total Revenue', '$' . number_format($totalRevenue, 2))
                ->description('Sum of all completed orders')
                ->color('success'),

            Stat::make('Total Orders', number_format($totalOrders))
                ->description('Number of completed orders')
                ->color('primary'),

            Stat::make('Average Order Value', '$' . number_format($averageOrder, 2))
                ->description('Revenue / Orders')
                ->color('warning'),
        ];
    }
}
