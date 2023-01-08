<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    public $table = 'members';

    protected $fillable = [
        'name',
        'age',
        'address',
        'telephone',
        'identity_number',
        'date_of_joined',
        'is_active',
    ];
}
