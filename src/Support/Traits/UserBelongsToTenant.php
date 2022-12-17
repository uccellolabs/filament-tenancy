<?php

namespace Uccellolabs\FilamentTenancy\Support\Traits;

use Illuminate\Database\Eloquent\Builder;
use Uccellolabs\FilamentTenancy\Models\Tenant;

trait UserBelongsToTenant
{
    use CurrentTenant;

    public static function bootUserBelongsToTenant()
    {

        if (!app()->runningInConsole()) { // Deactivate for console
            // Attach to current tenant id
            static::created(function ($model) {
                $tenant = static::getCurrentTenant();
                $tenant->users()->attach($model->id);
            });
        }
    }

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class);
    }

    public function lastTenant()
    {
        return $this->belongsTo(Tenant::class, 'last_tenant_id');
    }
}
