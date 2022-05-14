<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'phone_user';
}
