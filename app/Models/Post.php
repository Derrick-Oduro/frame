<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\TenantScope;

class Post extends Model
{
    protected static function booted()
{
    static::addGlobalScope(new TenantScope);

    static::creating(function ($post) {
        if (!$post->tenant_id && auth()->check()) {
            $post->tenant_id = auth()->user()->tenant_id;
        }

        if (!$post->user_id && auth()->check()) {
            $post->user_id = auth()->id();
        }
    });
}
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
        'tenant_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
     public function scopeForTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }
}
