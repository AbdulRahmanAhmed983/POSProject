<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use App\Models\Role;
use App\Models\Order;
use App\Models\Permission;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'password_confirmation',
        'image'

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
        public function getFirstNameAttribute($value){
            return ucfirst($value);
        }
        public function getLastNameAttribute($value){
            return ucfirst($value);
        }
        public function getImageAttribute($val)
        {
            return ($val !== null) ? ('images/' . $val) : "";

        }
       


    // public function roles()
    // {
    //     return $this->belongsToMany(App\Models\Role::class, 'role_user');
    // }
    // public function hasPermission($name)
    // {
    //     return $this->permissions()->where('name',$name)->exists();
    // }
}
