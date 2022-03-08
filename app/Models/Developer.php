<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;
    protected $table = "developers";
    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'photo',
    ];
}
