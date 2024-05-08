<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use NumberFormatter;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        $formatter = new NumberFormatter('vi', NumberFormatter::CURRENCY);

        return [
            Stat::make('Đơn hàng mới', Order::query()->where('status', 'new')->count()),
            Stat::make('Đang xử lý', Order::query()->where('status', 'processing')->count()),
            Stat::make('Đã giao hàng', Order::query()->where('status', 'delivered')->count()),
            Stat::make('Tổng doanh thu', function () use ($formatter) {
                $avgGrandTotal = Order::query()->sum('grand_total');
                return $formatter->formatCurrency($avgGrandTotal, 'VND');
            })
        ];
    }
}
