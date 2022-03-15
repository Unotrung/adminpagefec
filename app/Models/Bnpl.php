<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bnpl extends Model
{
<<<<<<< HEAD
    use HasFactory,HasRoles;
    protected $table = 'bnpls';
    protected $fillable = [
        'ncustomer',
        'phnumber',
        'image',
        'nidcustomer',
        'nidimage',
        'Gender',
        'Pincode',
    ];
    protected $guard_name = 'web';

=======
    use HasFactory;
>>>>>>> parent of 94253de (update employee)
}
