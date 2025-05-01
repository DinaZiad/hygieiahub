<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        if (Schema::hasTable('users')) {
            $adminEmail = 'admin@cleaningApp.com';
            
            if (!\App\Models\User::where('email', $adminEmail)->exists()) {
                \App\Models\User::create([
                    'name' => 'Admin',
                    'email' => $adminEmail,
                    'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                    'role' => 'admin',
                ]);
            }
        }
    }
}
