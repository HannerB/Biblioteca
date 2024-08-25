<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define(
            'see-reports',
            fn (User $user) =>
            $user->role == User::ROLE_TEACHER
        );

        Gate::define(
            'register-attendance',
            fn (User $user) =>
            $user->role == User::ROLE_TEACHER
        );

        Gate::define(
            'register-categories',
            fn (User $user) =>
            $user->role == User::ROLE_TEACHER
        );

        Gate::define(
            'book-return',
            fn (User $user) =>
            $user->role == User::ROLE_STUDENT
        );
    }
}
