<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'date',
        'time_in',
        'time_out',
        'latlong_in',
        'latlong_out',



    ];

}
