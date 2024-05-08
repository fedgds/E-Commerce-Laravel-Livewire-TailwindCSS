<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')
                    ->label('Mã đơn hàng')
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
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Action::make('Xem đơn hàng')
                        ->label('Xem đơn hàng')
                        ->url(fn (Order $record):string => OrderResource::getUrl('view', ['record' => $record]))
                        ->color('info')
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
