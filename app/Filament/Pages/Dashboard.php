<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
class Dashboard extends BaseDashboard
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-home';
    protected string $view = 'filament.pages.dashboard'; // <-- non-static now

    /**
     * Register dashboard widgets
     */
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\RevenueStats::class,
            \App\Filament\Widgets\TopCustomers::class,
            \App\Filament\Widgets\PopularProducts::class,
        ];
    }
}
