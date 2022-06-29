<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    const PERMISSION = [
        "super admin" => 1,
        "admin" => 2,
        "directeur" => 3,
        "caisse" => 4,
        "facturation" => 5,
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
        return array_values(self::PERMISSION);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }

    public function getPermissionAccessAttribute($value)
    {
        return array_search($value, self::PERMISSION);
    }
}
