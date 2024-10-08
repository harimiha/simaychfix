<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany('App\Models\User','role_id');
    }

    public function permission()
    {
        return $this->belongsToMany('App\Models\Permission','permissionroles');
    }
}
