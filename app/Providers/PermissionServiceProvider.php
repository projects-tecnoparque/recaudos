<?php

namespace App\Providers;

use Laravel\Lumen\Application;
use Illuminate\Contracts\Auth\Access\Gate;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\PermissionServiceProvider as spatiePermision;

class PermissionServiceProvider extends spatiePermision
{
    public function boot()
    {
        $this->offerPublishing();

        $this->registerMacroHelpers();

        $this->registerCommands();

        $this->registerModelBindings();

        $this->registerOctaneListener();

        $this->callAfterResolving(Gate::class, function (Gate $gate, Application $app) {
            if ($this->app['config']->get('permission.register_permission_check_method')) {
                /** @var PermissionRegistrar $permissionLoader */
                $permissionLoader = $app->get(PermissionRegistrar::class);
                $permissionLoader->clearPermissionsCollection();
                $permissionLoader->registerPermissions($gate);
            }
        });

        $this->app->singleton(PermissionRegistrar::class);
    }
}
