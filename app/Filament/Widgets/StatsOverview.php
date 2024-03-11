<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Clients;
use App\Models\Orders;
use App\Models\Product;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Clients', Clients::count())
            ->description('WA SDAA3')
            ->color('primary')
            ->chart([0,1]),
            Stat::make('Total Orders', Orders::count())
            ->description('Hado homa l`Orders')
            ->color('success')
            ->chart([0,5]),
            Stat::make('Orders Pending', Orders::where('status','completed')->count())
            ->description('Orders li Pending baqi matconfirmaw')
            ->color('gray'),
        ];
    }
}
