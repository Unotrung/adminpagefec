<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model;
use Maklad\Permission\Traits\HasRoles;
class Bnpl extends Model
{
    use HasFactory,HasRoles;
    protected $table = 'personals';
    protected $fillable = [
        'ncustomer',
        'phnumber',
        'image',
        'nidcustomer',
        'nidimage',
        'Gender',
        'Pincode',
        'DOB',
        'DON',
        'DRegis',
        'Address',
        'Code',
        'CodeName',
        'DivisionType',
        'District',
        'TypeRelation',
        'PhoneRelation',
        'NameRelation',
        'Contract',
    ];
    protected $guard_name = 'web';
}
