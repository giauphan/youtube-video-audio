<?php

namespace App\Filament\Pages;

use App\Settings\SettingBotBlog;
use Filament\Forms;
use Filament\Forms\Form;
use App\Filament\Base\SettingsPage;

class PageSettingBotBlog extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SettingBotBlog::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('bot_name')
                    ->required(),
                Forms\Components\TextInput::make('post_url')
                    ->required(),
                Forms\Components\TextInput::make('category_post')
                    ->required(),
                Forms\Components\TextInput::make('lang')
                    ->required(),
                Forms\Components\TextInput::make('limit_blog')
                    ->numeric()
                    ->required(),
            ]);
    }
}
