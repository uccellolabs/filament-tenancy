<?php

namespace Uccellolabs\FilamentTenancy;

use Filament\Facades\Filament;
use Filament\Support\Concerns\Configurable;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

class FilamentTenancySwitch
{
    use Configurable;

    public static function boot(): void
    {
        $self = new static();
        $self->configure();
        $self->injectComponent();
    }

    public function injectComponent(): void
    {
        Livewire::component('switch-filament-tenant', Http\Livewire\SwitchFilamentTenant::class);
        Filament::registerRenderHook(
            'global-search.end',
            fn (): string => Blade::render("@livewire('switch-filament-tenant')")
        );
    }
}
