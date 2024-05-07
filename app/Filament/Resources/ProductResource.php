<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Thông tin sản phẩm')->schema([
                        TextInput::make('name')
                            ->label('Tên sản phẩm')
                            ->placeholder('Nhập tên sản phẩm')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->unique(Product::class, 'slug', ignoreRecord: true),

                        TextInput::make('price')
                            ->label('Giá')
                            ->placeholder('Nhập giá sản phẩm')
                            ->columnSpanFull()
                            ->numeric()
                            ->minValue(1)
                            ->prefix('VND')
                            ->required(),

                        MarkdownEditor::make('description')
                            ->label('Mô tả')
                            ->placeholder('Mô tả sản phẩm')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products')
                    ])->columns(2),

                    Section::make('Chọn ảnh')->schema([
                        FileUpload::make('images')
                            ->label('Ảnh')
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable()
                    ])
                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make('Quan hệ')->schema([
                        Select::make('category_id')
                            ->label('Danh mục')
                            ->placeholder('Chọn danh mục')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name'),

                        Select::make('brand_id')
                            ->label('Hãng')
                            ->placeholder('Chọn hãng')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('brand', 'name')
                    ]),

                    Section::make('Trạng thái')->schema([
                        Toggle::make('in_stock')
                            ->label('Tồn kho')
                            ->required()
                            ->default(true),
                        Toggle::make('is_active')
                            ->label('Hiển thị')
                            ->required()
                            ->default(true),
                        Toggle::make('is_featured')
                            ->label('Nổi bật')
                            ->required(),
                        Toggle::make('on_sale')
                            ->label('Giảm giá')
                            ->required()
                    ])
                ])->columnSpan(1)

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Tên sản phẩm')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Danh mục')
                    ->sortable(),

                TextColumn::make('brand.name')
                    ->label('Hãng')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Giá')
                    ->money('VND')
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->boolean(),

                IconColumn::make('on_sale')
                    ->label('Giảm giá')
                    ->boolean(),

                IconColumn::make('in_stock')
                    ->label('Tồn kho')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Hiển thị')
                    ->boolean(),

            ])
            ->filters([
                SelectFilter::make('Danh mục')
                    ->relationship('category', 'name'),

                SelectFilter::make('Hãng')
                    ->relationship('brand', 'name')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
