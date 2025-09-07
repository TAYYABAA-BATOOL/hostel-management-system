<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'hostel_name',
        'contact_email',
        'contact_phone',
        'address',
    ];
}
