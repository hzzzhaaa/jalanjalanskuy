<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        parent::boot();

        Route::bind('user', function ($value, $route) {
            return $this->getModel(\App\User::class, $value);
        });

        Route::bind('event', function ($value, $route) {
            return $this->getModel(\App\Event::class, $value);
        });

        Route::bind('organizer', function ($value, $route) {
            return $this->getModel(\App\Organizer::class, $value);
        });

        Route::bind('ticket', function ($value, $route) {
            return $this->getModel(\App\Ticket::class, $value);
        });

        Route::bind('division', function ($value, $route) {
            return $this->getModel(\App\Division::class, $value);
        });

        // Route::bind('ticketuser', function ($value, $route) {
        //     return $this->getModel(\App\TicketUser::class, $value);
        // });
    }

    private function getModel($model, $routeKey)
    {
    $id = \Hashids::connection($model)->decode($routeKey)[0] ?? null;
    $modelInstance = resolve($model);

    return  $modelInstance->findOrFail($id);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
