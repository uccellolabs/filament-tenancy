<?php

namespace Uccellolabs\FilamentTenancy\Support\Traits;

use Uccellolabs\FilamentTenancy\Models\Tenant;

trait CurrentTenant
{
    protected static function getCurrentTenant()
    {
        if (auth()->guest()) {
            return null;
        }

        $currentTenant = Tenant::find(auth()->user()->current_tenant_id);

        if (empty($currentTenant)) {
            $currentTenant = auth()->user()->tenants()->first();

            if ($currentTenant) {
                auth()->user()->update(['current_tenant_id' => $currentTenant->id]);
            }
        }

        return $currentTenant;
    }
}
