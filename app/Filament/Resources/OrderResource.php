<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Thông tin đặt hàng')->schema([
                        Select::make('user_id')
                            ->label('Khách hàng')
                            ->placeholder('Chọn khách hàng')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('payment_method')
                            ->label('Phương thức thanh toán')
                            ->placeholder('Chọn phương thức thanh toán')
                            ->options([
                                'momo' => 'Momo',
                                'cod' => 'Tiền mặt'
                            ])
                            ->required(),

                        Select::make('payment_status')
                            ->label('Trạng thái thanh toán')
                            ->placeholder('Chọn trạng thái thanh toán')
                            ->options([
                                'pending' => 'Chờ xác nhận',
                                'paid' => 'Đã thanh toán',
                                'failed' => 'Thất bại'
                            ])
                            ->required(),

                        ToggleButtons::make('status')
                            ->label('Trạng thái đơn hàng')
                            ->inline()
                            ->default('new')
                            ->required()
                            ->options([
                                'new' => 'Mới',
                                'processing' => 'Đang xử lý',
                                'shipped' => 'Đang giao hàng',
                                'delivered' => 'Đã giao hàng',
                                'cancelled' => 'Đã hủy'
                            ])
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'success',
                                'delivered' => 'success',
                                'cancelled' => 'danger'
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'shipped' => 'heroicon-m-truck',
                                'delivered' => 'heroicon-m-check-badge',
                                'cancelled' => 'heroicon-m-x-circle'
                            ]),

                            Select::make('shipping_method')
                                ->label('Phương thức vận chuyển')
                                ->placeholder('Chọn phương thức vận chuyển')
                                ->options([
                                    'vietnam_post' => 'Bưu điện Việt Nam',
                                    'viettel_post' => 'Viettel Post',
                                    'ghn' => 'Giao hàng nhanh',
                                    'grab_express' => 'Grab Express'
                                ])
                                ->required()
                                ->columnSpanFull(),

                            Textarea::make('notes')
                                ->label('Ghi chú')
                                ->columnSpanFull()
                    ])->columns(2),

                    Section::make('Đơn hàng')->schema([
                        Repeater::make('items')
                            ->label('')
                            ->relationship()
                            ->schema([

                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->label('Sản phẩm')
                                    ->placeholder('Chọn sản phẩm')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, Set $set) => $set('unit_price', Product::find($state)?->price ?? 0))
                                    ->afterStateUpdated(fn ($state, Set $set) => $set('total_price', Product::find($state)?->price ?? 0))
                                    ->columnSpan(4),

                                TextInput::make('quantity')
                                    ->label('Số lượng')
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_price', $state*$get('unit_price')))
                                    ->columnSpan(2),

                                TextInput::make('unit_price')
                                    ->label('Đơn giá')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),

                                TextInput::make('total_price')
                                    ->label('Thành tiền')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3)
                            ])->columns(12),

                            Placeholder::make('Tổng cộng')
                                ->label('Tổng cộng')
                                ->content(function (Get $get, Set $set) {
                                    $total = 0;
                                    if (!$repeaters = $get('items')) {
                                        return $total;
                                    }

                                    foreach($repeaters as $key => $repeaters) {
                                        $total += $get("items.{$key}.total_price");
                                    }
                                    $set('grand_total', $total);
                                    return number_format($total, 0, ',', '.') . 'đ';
                                }),

                            Hidden::make('grand_total')
                                ->default(0)
                    ])

                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Khách hàng')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('grand_total')
                    ->label('Tổng tiền')
                    ->numeric()
                    ->sortable()
                    ->money('VND'),

                TextColumn::make('payment_method')
                    ->label('Phương thức thanh toán')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return match($record->payment_method) {
                            'momo' => 'Momo',
                            'cod' => 'Tiền mặt'
                        };
                    }),

                TextColumn::make('payment_status')
                    ->label('Trạng thái thanh toán')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return match($record->payment_status) {
                            'pending' => 'Chờ xác nhận',
                            'paid' => 'Đã thanh toán',
                            'failed' => 'Thất bại'
                        };
                    }),

                TextColumn::make('shipping_method')
                    ->label('Vận chuyển')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return match($record->shipping_method) {
                            'vietnam_post' => 'Bưu điện Việt Nam',
                            'viettel_post' => 'Viettel Post',
                            'ghn' => 'Giao hàng nhanh',
                            'grab_express' => 'Grab Express'
                        };
                    }),
                    
                SelectColumn::make('status')
                    ->label('Trạng thái đơn hàng')
                    ->options([
                        'new' => 'Mới',
                        'processing' => 'Đang xử lý',
                        'shipped' => 'Đang giao hàng',
                        'delivered' => 'Đã giao hàng',
                        'cancelled' => 'Đã hủy'
                    ])
                    ->placeholder(null),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'danger' : 'success';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
