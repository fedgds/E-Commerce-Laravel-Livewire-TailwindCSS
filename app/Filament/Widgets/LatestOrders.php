<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Mã đơn hàng')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Khách hàng')
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->label('Tổng tiền')
                    ->money('VND'),

                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return match($record->status) {
                            'new' => 'Mới',
                            'processing' => 'Đang xử lý',
                            'shipped' => 'Đang giao hàng',
                            'delivered' => 'Đã giao hàng',
                            'cancelled' => 'Đã hủy',
                        };
                    }),
                
                TextColumn::make('payment_method')
                    ->label('Phương thức thanh toán')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(function ($record) {
                        return match($record->payment_method) {
                            'momo' => 'Momo',
                            'cod' => 'Tiền mặt'
                        };
                    }),
                
                TextColumn::make('payment_status')
                    ->label('Trạng thái thanh toán')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(function ($record) {
                        return match($record->payment_status) {
                            'pending' => 'Chờ xác nhận',
                            'paid' => 'Đã thanh toán',
                            'failed' => 'Thất bại'
                        };
                    }),

                TextColumn::make('created_at')
                    ->label('Ngày đặt')
                    ->date()
            ])
            ->actions([
                Action::make('Xem đơn hàng')
                        ->label('Xem đơn hàng')
                        ->url(fn (Order $record):string => OrderResource::getUrl('view', ['record' => $record]))
                        ->color('info')
                        ->icon('heroicon-o-eye')
            ]);
    }
}
