<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends \Illuminate\Foundation\Support\Providers\AuthServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-customers', function (User $user) {
            // alle angemeldeten Nutzer mit Rolle 'user' oder 'admin'
            return in_array($user->role, ['user','admin'], true);
        });

        Gate::define('admin-access', function (User $user) {
            return $user->isAdmin();
        });
    }
}
