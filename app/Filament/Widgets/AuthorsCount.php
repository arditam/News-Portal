<?php

namespace App\Filament\Widgets;

use App\Models\Author;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AuthorsCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Authors', Author::count())
                ->description('Number of registered authors')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary'),
        ];

        
    }
}