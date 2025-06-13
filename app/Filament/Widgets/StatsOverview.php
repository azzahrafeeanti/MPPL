<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userTotal = User::count();
        $incomeTotal = Transaction::sum('grand_total_amount');
        $orderTotal = Transaction::count();
        return [
            //
            Stat::make('Total User', $userTotal)
            ->description('32k increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),

            Stat::make('Total Pemasukan', $incomeTotal)
            ->description('7% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->chart([17, 15, 10, 11, 15, 4, 2])
            ->color('danger'),

            Stat::make('Total Order', $orderTotal)
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 8, 6, 9, 10, 12, 17])
            ->color('success'),
        ];
    }
}
