<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // v1: keine Policies nötig
    ];

    public function boot(): void {
        \Illuminate\Support\Facades\Gate::define("view-customers", function (?\App\Models\User $user): bool {
            return in_array($user?->role, ["user","admin"], true);
        });

        // Wenn ability 'admin-access': admin-Role erlaubt IMMER (überspringt wackelige Registrierungen/Caches)
        Gate::before(function (?User $user, string $ability) {
            if ($ability === 'admin-access') {
                return $user?->role === 'admin';
            }
            return null; // andere Abilities normal prüfen
        });

        // Vollständigkeit: definiere ability trotzdem normal
        Gate::define('admin-access', function (?User $user): bool {
            return $user?->role === 'admin';
        });
    }
}
