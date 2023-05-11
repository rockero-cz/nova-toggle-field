<?php

namespace Rockero\NovaToggleField;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-toggle-field', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-toggle-field', __DIR__.'/../dist/css/field.css');
        });

        Route::middleware(['nova'])
            ->prefix('nova-vendor/toggle-field')
            ->group(function () {
                Route::post('/{resource}/update', ToggleFieldController::class);
            });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
