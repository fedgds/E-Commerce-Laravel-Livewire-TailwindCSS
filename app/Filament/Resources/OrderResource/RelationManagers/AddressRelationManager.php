<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('full_name')
                    ->label('Họ và Tên')
                    ->placeholder('Nhập họ và tên')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('phone')
                    ->label('Điện thoại')
                    ->placeholder('Nhập số điện thoại')
                    ->required()
                    ->tel()
                    ->maxLength(20)
                    ->columnSpanFull(),

                TextInput::make('address')
                    ->label('Địa chỉ')
                    ->placeholder('Nhập địa chỉ')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('district')
                    ->label('Quận/Huyện')
                    ->placeholder('Nhập quận/huyện')
                    ->required()
                    ->maxLength(255),

                TextInput::make('city')
                    ->label('Thành phố')
                    ->placeholder('Nhập thành phố')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('city')
            ->columns([
                TextColumn::make('full_name')
                    ->label('Tên'),

                TextColumn::make('phone')
                    ->label('SĐT'),

                TextColumn::make('address')
                    ->label('Địa chỉ'),

                TextColumn::make('district')
                    ->label('Quận/Huyện'),

                TextColumn::make('city')
                    ->label('Thành phố'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
