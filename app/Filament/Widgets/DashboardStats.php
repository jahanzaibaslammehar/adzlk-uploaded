<?php

namespace App\Filament\Widgets;

use App\Models\Ad;
use App\Models\Poster;
use App\Models\Transactions;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Ads', Ad::count())
                ->description('All ads in the system')
                ->icon('heroicon-o-rectangle-stack')
                ->color('success'),

            Stat::make('Total fake Ads', Ad::where('is_fake')->count())
                ->description('All ads in the system')
                ->icon('heroicon-o-rectangle-stack')
                ->color('success'),

            Stat::make('Total Super Ads', Ad::where('ad_type', 2)->count())
                ->description('All Super ads in the system')
                ->icon('heroicon-o-rectangle-stack')
                ->color('success'),

            Stat::make('Total VIP Ads', Ad::where('ad_type', 3)->count())
                ->description('All VIP ads in the system')
                ->icon('heroicon-o-rectangle-stack')
                ->color('success'),

            Stat::make('Total Normal Ads', Ad::where('ad_type', 1)->count())
                ->description('All Normal ads in the system')
                ->icon('heroicon-o-rectangle-stack')
                ->color('success'),

            Stat::make('Total Posters', Poster::count())
                ->description('Registered posters')
                ->icon('heroicon-o-users')
                ->color('primary'),


            Stat::make('Verified Posters', Poster::where('is_verified', true)->count())
                ->description('Posters verified their profiles')
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make('Unverified Posters', Poster::where('is_verified', false)->count())
                ->description('Posters verified their profiles')
                ->icon('heroicon-o-users')
                ->color('danger'),

            Stat::make('Total Transactions', Transactions::count())
                ->description('Total transactions in the system')
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make('Total earnings', Transactions::sum('amount'))
                ->description('Total earnings in the system')
                ->icon('heroicon-o-users')
                ->color('success'),
        ];
    }
}
