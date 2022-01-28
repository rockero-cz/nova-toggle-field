<?php

namespace Rockero\NovaToggleField;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Rockero\NovaToggleField\ToggleFieldController;

class FieldServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-toggle-field', __DIR__.'/../dist/js/field.js');
        });

        Route::middleware(['nova'])
            ->prefix('nova-vendor/toggle-field')
            ->group(function () {
                Route::post('/{resource}/update', ToggleFieldController::class);
            });
    }
}
