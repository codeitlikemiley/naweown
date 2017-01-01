<?php

namespace Naweown\Providers;

use Naweown\Token;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'Naweown\Http\Controllers';

    public function boot()
    {
        parent::boot();

        Route::bind("token", function (string $token) {
            return Token::findByToken($token);
        });
    }

    public function map()
    {
        $this->mapRoutes();
    }

    protected function mapRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }
}
