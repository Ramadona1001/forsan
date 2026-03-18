<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::share('siteSettings', \App\Models\SiteSetting::getSettings());

        \Illuminate\Support\Facades\View::composer('partials.header', function ($view) {
            $overviewPage = \App\Models\InformationPage::where('slug', 'equestrian-sports-overview')->first();
            $view->with('equestrianSports', $overviewPage ? $overviewPage->equestrianSports()->active()->ordered()->get() : collect());
        });

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en'])
                ->labels([
                    'ar' => 'العربية',
                    'en' => 'English',
                ])
                ->flags([
                    'ar' => asset('images/flags/sa.svg'),
                    'en' => asset('images/flags/us.svg'),
                ])
                ->circular();
        });
    }
}
