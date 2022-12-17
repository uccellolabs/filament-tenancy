<?php

namespace Uccellolabs\FilamentTenancy\Support\Traits;

use Uccellolabs\FilamentTenancy\Models\Tenant;

trait CurrentTenant
{
    protected static function getCurrentTenant()
    {
        $currentTenant = Tenant::find(auth()->user()->last_tenant_id);

        if (empty($currentTenant)) {
            $currentTenant = auth()->user()->tenants()->first();

            if ($currentTenant) {
                auth()->user()->update(['last_tenant_id' => $currentTenant->id]);
            }
        }

        return $currentTenant;
    }
}
