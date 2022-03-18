<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Maklad\Permission\Traits\HasRoles;
class Bnpl extends Model
{
    use HasFactory,HasRoles;
    protected $table = 'bnpls';
    protected $fillable = [
        'name',
        'sex',
        'birthday',
        'phone',
        'citizenId',
        'issueDate',
        'city',
        'district',
        'ward',
        'street',
        'personal_title_ref',
        'name_ref',
        'phone_ref',
        'user',
    ];
    protected $guard_name = 'web';

}
