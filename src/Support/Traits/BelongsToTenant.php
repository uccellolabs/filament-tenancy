<?php

namespace Uccellolabs\FilamentTenancy\Support\Traits;

use Illuminate\Database\Eloquent\Builder;
use Uccellolabs\FilamentTenancy\Models\Tenant;

trait BelongsToTenant
{
    use CurrentTenant;

    public static function bootBelongsToTenant()
    {
        if (!app()->runningInConsole()) { // Deactivate for console
            // Add current tenant id
            static::creating(function ($model) {
                $tenant = static::getCurrentTenant();
                $model->tenant_id = $tenant->id;
            });

            // Filter data on user tenant
            static::addGlobalScope('tenant', function (Builder $builder) {
                $tenant = static::getCurrentTenant();
                $builder->where((new static)->getTable() . '.tenant_id', $tenant->id);
            });
        }
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
