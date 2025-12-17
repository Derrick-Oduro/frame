<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Permission extends Model
{
    protected $fillable = [
        "name",
        "guard_name",
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class,"role_has_permissions","permission_id","role_id");
    }
}
