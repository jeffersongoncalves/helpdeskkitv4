<?php

namespace App\Providers\Filament;

use App\Filament\Operator\Pages\Auth\Login;
use Filament\Actions\Action;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use JeffersonGoncalves\Filament\Pwa\FilamentPwaPlugin;
use JeffersonGoncalves\FilamentHelpDesk\FilamentHelpDeskOperatorPlugin;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;

class OperatorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('operator')
            ->path('operator')
            ->login(Login::class)
            ->authGuard('operator')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->brandLogo(fn () => Vite::asset(config('helpdeskkit.logo')))
            ->brandLogoHeight(fn () => request()->is('operator/login', 'operator/password-reset/*') ? '121px' : '50px')
            ->viteTheme('resources/css/filament/operator/theme.css')
            ->defaultThemeMode(config('helpdeskkit.theme_mode', ThemeMode::Dark))
            ->discoverClusters(in: app_path('Filament/Operator/Clusters'), for: 'App\\Filament\\Operator\\Clusters')
            ->discoverPages(in: app_path('Filament/Operator/Pages'), for: 'App\\Filament\\Operator\\Pages')
            ->discoverResources(in: app_path('Filament/Operator/Resources'), for: 'App\\Filament\\Operator\\Resources')
            ->discoverWidgets(in: app_path('Filament/Operator/Widgets'), for: 'App\\Filament\\Operator\\Widgets')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
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
            ])
            ->navigationGroups([
                __('Tickets'),
                __('Settings'),
            ])
            ->plugins([
                FilamentPwaPlugin::make(),
                FilamentHelpDeskOperatorPlugin::make(),
                FilamentEditProfilePlugin::make()
                    ->slug('my-profile')
                    ->setTitle(__('My Profile'))
                    ->setNavigationLabel(__('My Profile'))
                    ->setNavigationGroup(__('Group Profile'))
                    ->setIcon('heroicon-o-user')
                    ->setSort(10)
                    ->shouldRegisterNavigation(false)
                    ->shouldShowEmailForm()
                    ->shouldShowLocaleForm(options: [
                        'pt_BR' => __('🇧🇷 Português'),
                        'en' => __('🇺🇸 Inglês'),
                        'es' => __('🇪🇸 Espanhol'),
                    ])
                    ->shouldShowThemeColorForm()
                    ->shouldShowSanctumTokens()
                    ->shouldShowMultiFactorAuthentication()
                    ->shouldShowBrowserSessionsForm()
                    ->shouldShowAvatarForm(),
            ])
            ->userMenuItems([
                'profile' => Action::make('profile')
                    ->label(fn (): string => __('My Profile'))
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle'),
            ])
            ->unsavedChangesAlerts()
            ->passwordReset()
            ->profile()
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s');
    }
}
