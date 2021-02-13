<?php

namespace App\Providers;

use App\Http\View\Composers\ProfileComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\SchemaOrg\Schema;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $founder = Schema::person()
            ->name('Stef van den Ham')
            ->image('https://mindthecode.com/avatar.jpg');

        $localBusiness = Schema::organization()
            ->name('Mindthecode')
            ->legalName('Mindthecode.com')
            ->url('https://mindthecode.com')
            ->logo('https://mindthecode.com/logo.png')
            ->foundingDate('2011')
            ->email('stef@mindthecode.com')
            ->founders($founder)
            ->contactPoint(Schema::contactPoint()->areaServed('Worldwide'));

        // echo $localBusiness->toScript();
        view()->share('schemawebsite', $localBusiness);
    }
}
