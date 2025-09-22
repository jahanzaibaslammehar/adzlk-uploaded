<?php

namespace App\Filament\Resources\Ads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('poster.phone')
                ->searchable()
                ->label('User')
                // ->numeric()
                ->sortable(),
                    TextColumn::make('poster.id')
                    ->label('User ID')
                        ->numeric()
                        ->sortable(),

                ImageColumn::make('image')
                 ->getStateUsing(fn ($record) => asset('public/storage/' . $record->image)),

                    // ->disk('public')
                    // ->visibility('public'),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                IconColumn::make('is_on_whatsapp')
                    ->boolean(),
                IconColumn::make('is_on_telegram')
                    ->boolean(),
                IconColumn::make('is_on_imo')
                    ->boolean(),
                IconColumn::make('is_on_viber')
                    ->boolean(),
                IconColumn::make('is_active')
                    ->boolean(),
                IconColumn::make('is_fake')
                    ->boolean(),
                TextColumn::make('ad_type')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_likes')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_views')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
