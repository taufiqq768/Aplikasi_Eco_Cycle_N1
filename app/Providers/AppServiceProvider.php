<?php

namespace App\Providers;

use App\Enum\UserRoleEnum;
use App\Models\User;
use Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive('thousands', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'); ?>";
        });
        Blade::directive('comma', function ($expression) {
            if ($expression === 0) {
                return "<?php echo '-'; ?>";
            }
            return "<?php echo number_format($expression, 2, ',', '.'); ?>";
        });
        Blade::directive('ton', function ($expression) {
            return "<?php echo number_format(($expression) / 1000, 0, '', '.'); ?>";
        });
        Blade::directive('percent', function ($expression) {
            list($value, $total) = explode(',', str_replace(['(', ')', ' '], '', $expression));
            return "<?php 
            if ($value == 0 || $total == 0) {
                echo '0%';
            } else {
                echo number_format(($value / $total) * 100, 2) . '%';
            }
            ?>";
        });

        Gate::define('access_for', function (User $user, ...$role) {
            if ($user->role == UserRoleEnum::SUPER_ADMIN->name) {
                return true;
            }
            return in_array($user->role, $role);
        });
    }
}
