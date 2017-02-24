<?php

namespace Laralum\Users;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use Laralum\Users\Models\User;
use Laralum\Users\Policies\UserPolicy;

use Laralum\Permissions\PermissionsChecker;

class UsersServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * The mandatory permissions for the module.
     *
     * @var array
     */
    protected $permissions = [
        [
            'name' => 'Users Access',
            'slug' => 'laralum::users.access',
            'desc' => "Grants access to laralum/users module",
        ],
        [
            'name' => 'Create Users',
            'slug' => 'laralum::users.create',
            'desc' => "Allows creating users",
        ],
        [
            'name' => 'Update Users',
            'slug' => 'laralum::users.update',
            'desc' => "Allows updating users",
        ],
        [
            'name' => 'View Users',
            'slug' => 'laralum::users.view',
            'desc' => "Allows previewing users",
        ],
        [
            'name' => 'Manage Users Roles',
            'slug' => 'laralum::users.roles',
            'desc' => "Grants access to manage user roles",
        ],
        [
            'name' => 'Delete Users',
            'slug' => 'laralum::users.delete',
            'desc' => "Allows delete users",
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->loadTranslationsFrom(__DIR__.'/Translations', 'laralum_users');

        $this->loadViewsFrom(__DIR__.'/Views', 'laralum_users');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
        }

        // Make sure the permissions are OK
        PermissionsChecker::check($this->permissions);

    }


    /**
     * I cheated this comes from the AuthServiceProvider extended by the App\Providers\AuthServiceProvider
     *
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
