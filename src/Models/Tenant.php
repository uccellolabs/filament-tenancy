<?php

namespace Uccellolabs\FilamentTenancy\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tenant extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'data',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
