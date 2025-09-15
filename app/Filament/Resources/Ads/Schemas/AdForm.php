<?php

namespace App\Filament\Resources\Ads\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('poster_id')
                    ->relationship('poster', 'phone')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('ads')
                    ->visibility('public')
                    ->imageEditor(true)
                    ->required(),
                TextInput::make('title')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                RichEditor::make('description')
                    ->label('Description')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'strike',
                        'link',
                        'blockquote',
                        'h2',
                        'h3',
                        'bulletList',
                        'orderedList',
                        'codeBlock',
                    ])
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_on_whatsapp')
                    ->required(),
                Toggle::make('is_on_telegram')
                    ->required(),
                Toggle::make('is_on_imo')
                    ->required(),
                Toggle::make('is_on_viber')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_fake')
                    ->required(),
                Select::make('ad_type')
                    ->options([
                        '1' => 'Normal',
                        '2' => 'SuperAd',
                        '3' => 'VIP Ad'
                    ])
                    ->required(),
                // TextInput::make('total_likes')
                //     ->required()
                //     ->numeric()
                //     ->default(0),
                // TextInput::make('total_views')
                //     ->required()
                //     ->numeric()
                //     ->default(0),
            ]);
    }
}
