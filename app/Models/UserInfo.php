<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Maklad\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Foundation\Auth\User as Authenticatable;

class UserInfo extends Model
{
    use HasFactory,Authenticatable,Notifiable,HasApiTokens,HasRoles;
    protected $connection = 'mongodb';
    protected $collection = 'userinfo'; 


    protected $fillable = [
        'user_id',
    ];
}
?>
