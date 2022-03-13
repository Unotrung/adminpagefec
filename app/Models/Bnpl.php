<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Model;
use Maklad\Permission\Traits\HasRoles;


class Bnpl extends Model
{
    use HasFactory,HasRoles;
    protected $guard_name = 'web';

}
