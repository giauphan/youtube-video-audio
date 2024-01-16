<?php

namespace App\Filament\Pages;

use App\Filament\Base\SettingsPage as BaseSettingsPage;
use App\Settings\SettingGoogle;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;

class ManageGoogle extends BaseSettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SettingGoogle::class;

    public function form(Form $form): Form
    {
        $providers = ['gtag', 'analytic', 'googleAds'];

        $schema = [];

        foreach ($providers as $key => $provider) {
            $schema[] = Section::make()
                ->heading(ucfirst($provider))
                ->schema([
                    Checkbox::make("{$provider}_enabled")
                        ->label('Kích hoạt')
                        ->reactive()
                        ->helperText(sprintf('kích hoạt %s.', ucfirst($provider))),
                    Group::make()
                        ->hidden(fn (Get $get) => ! $get("{$provider}_enabled"))
                        ->schema([
                            TextInput::make("{$provider}_id")
                                ->label($provider.' ID')
                                ->password(app()->isProduction())
                                ->required(fn (Get $get) => $get("{$provider}_enabled")),
                        ]),
                ]);
        }

        return $form->schema($schema);
    }
}
