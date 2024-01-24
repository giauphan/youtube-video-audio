<?php

declare(strict_types=1);

namespace App\Filament\Base;

use App\Filament\Pages\ManageGoogle;
use App\Filament\Pages\PageSettingBotBlog;
use App\Filament\Pages\SettingApiVideo;
use Filament\Navigation\NavigationItem;
use Filament\Pages\SettingsPage as BaseSettingsPage;

abstract class SettingsPage extends BaseSettingsPage
{
    protected static string $view = 'filament.base.settings-page';

    public function getSidebarItems(): array
    {
        return [
            NavigationItem::make()
                ->label(__('Setting Google'))
                ->icon('heroicon-o-cog')
                ->isActiveWhen(fn () => $this instanceof ManageGoogle)
                ->url(ManageGoogle::getUrl()),
            NavigationItem::make()
                ->label(__('Setting Api video youtube'))
                ->icon('heroicon-o-globe-alt')
                ->isActiveWhen(fn () => $this instanceof SettingApiVideo)
                ->url(SettingApiVideo::getUrl()),
            NavigationItem::make()
                ->label(__('Setting Bot crawl blog'))
                ->icon('heroicon-o-globe-alt')
                ->isActiveWhen(fn () => $this instanceof PageSettingBotBlog)
                ->url(PageSettingBotBlog::getUrl()),
        ];
    }
}
