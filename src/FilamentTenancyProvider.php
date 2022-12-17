<?php

namespace Uccellolabs\FilamentTenancy;

use Filament\Facades\Filament;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentTenancyProvider extends PluginServiceProvider
{
    public static string $name = 'filament-tenancy';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasViews()
            ->hasMigrations('create_tenants_table', 'create_tenant_user_table', 'alter_users_table');
    }

    public function packageBooted(): void
    {
        Filament::serving(fn () => FilamentTenancySwitch::boot());
    }
}
