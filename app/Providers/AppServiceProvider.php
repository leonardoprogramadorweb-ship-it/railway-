<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Define el permiso exclusivo para el rol de administrador
        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });
    }
}