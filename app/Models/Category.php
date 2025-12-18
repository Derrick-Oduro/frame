<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\TenantScope;

class Category extends Model
{
     protected static function booted()
    {
        static::addGlobalScope(new TenantScope());

        static::creating(function ($category) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $category->tenant_id = auth()->user()->tenant_id;
            }
        });
    }
    protected $fillable = [
        "name",
        "slug",
        "tenant_id",
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
