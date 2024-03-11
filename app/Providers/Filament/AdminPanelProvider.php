<?php

namespace App\Providers\Filament;

use App\Filament\Pages\ManageGoogle;
use App\Filament\Resources\BotBlogResource;
use App\Filament\Resources\CategoryBlogResource;
use App\Filament\Resources\CommentResource;
use App\Filament\Resources\FailedJobResource;
use App\Filament\Resources\JobResource;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\RoleResource;
use App\Filament\Resources\SessionResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\YoutubeVideoResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->navigation(
                function (NavigationBuilder $builder): NavigationBuilder {
                    return $builder
                        ->items([
                            ...Pages\Dashboard::getNavigationItems(),
                            NavigationItem::make()
                                ->label('Cài đặt')
                                ->icon('heroicon-o-cog')
                                ->url(ManageGoogle::getUrl())
                                ->isActiveWhen(fn () => Route::is('filament.admin.pages.settings.*')),
                        ])
                        ->groups([
                            NavigationGroup::make(__('Video'))
                                ->items([
                                    ...FailedJobResource::getNavigationItems(),
                                    ...JobResource::getNavigationItems(),
                                    ...YoutubeVideoResource::getNavigationItems(),
                                ]),
                        ])
                        ->groups([
                            NavigationGroup::make(__('Post'))
                                ->items([
                                    ...CategoryBlogResource::getNavigationItems(),
                                    ...PostResource::getNavigationItems(),
                                    ...BotBlogResource::getNavigationItems(),
                                    ...CommentResource::getNavigationItems()
                                ]),
                        ])
                        ->groups([
                            NavigationGroup::make(__('User'))
                                ->items([
                                    ...RoleResource::getNavigationItems(),
                                    ...SessionResource::getNavigationItems(),
                                    ...UserResource::getNavigationItems(),
                                ]),
                        ]);
                }
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
