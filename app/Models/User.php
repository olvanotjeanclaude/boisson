<?php

namespace App\Models;

use App\helper\Access;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isSuperAdmin(){
        return getUserPermission()=="super admin";
    }

    public function isAdmin(){
        return getUserPermission()=="admin";
    }

    public function isCaisse(){
        return getUserPermission()=="caisse";
    }

    public function isDirector(){
        return getUserPermission()=="directeur";
    }

    public function isFacturation(){
        return getUserPermission()=="facturation";
    }

    public function scopePermissionKeys()
    {
        return array_values(Access::ROLES);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }

    public function getPermissionAccessAttribute($value)
    {
        return array_search($value, Access::ROLES);
    }
}
