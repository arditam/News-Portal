<?php

namespace App\Filament\Widgets;

use App\Models\NewsCategory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NewsPerCategory extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = [];
        
        $categories = NewsCategory::withCount('news')->get();
        
        foreach ($categories as $category) {
            $stats[] = Stat::make($category->title, $category->news_count)
                ->description("News in {$category->title}")
                ->descriptionIcon('heroicon-o-document-text')
                ->color('success');
        }
        
        return $stats;
    }
}