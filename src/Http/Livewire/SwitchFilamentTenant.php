<?php

namespace Uccellolabs\FilamentTenancy\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Uccellolabs\FilamentTenancy\Support\Traits\CurrentTenant;

class SwitchFilamentTenant extends Component
{
    use CurrentTenant;

    public function changeTenant($tenantId)
    {
        auth()->user()->update(['current_tenant_id' => $tenantId]);

        $this->redirect(request()->header('Referer'));
    }

    public function render(): View
    {
        return view('filament-tenancy::tenant-switch', [
            'currentTenant' => static::getCurrentTenant(),
        ]);
    }
}
