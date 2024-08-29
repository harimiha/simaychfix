<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ACL
    public function can($ability=null, $arguments = [])
    {
        return !is_null($ability) && $this->checkPermission($ability);
    }

    public function getRole()
    {
        return $this->belongsTo('App\Models\Role','role_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    protected function checkPermission($perm)
    {
        $permissions     = $this->getAllPermissionsAllRoles();
        $permissionArray = is_array($perm) ? $perm : [$perm];

        return count(array_intersect($permissions, $permissionArray));
    }

    protected function getAllPermissionsAllRoles()
    {
        $permissionsFlat = $this->role->permission->pluck('slug')->toArray();
        return $permissionsFlat;
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role->name==$role;
        }
        return false;
    }
}
