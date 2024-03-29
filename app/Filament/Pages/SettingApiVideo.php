<?php

namespace App\Filament\Pages;

use App\Filament\Base\SettingsPage as BaseSettingsPage;
use App\Settings\APiVideo;
use Filament\Forms;
use Filament\Forms\Form;

class SettingApiVideo extends BaseSettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = APiVideo::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('url')
                    ->required(),
                Forms\Components\TextInput::make('client_id')
                    ->required(),
                Forms\Components\TextInput::make('client_secret')
                    ->required(),
                Forms\Components\TextInput::make('username')
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(),
            ]);
    }
}
