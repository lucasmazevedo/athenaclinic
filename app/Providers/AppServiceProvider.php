<?php

namespace App\Providers;

use App\Models\Tenant\Caixa;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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

        view()->composer('*', function ($view) {
            $caixa = Caixa::where('status', 0)->count();
            $view->with('caixa', $caixa);
        });

        Relation::enforceMorphMap([
            'medico' => 'App\Models\Tenant\Medico',
            'funcionario' => 'App\Models\Tenant\Funcionario',
        ]);
    }
}
