<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jemaat extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'name',
        'placeofbirth',
        'dateofbirth',
        'gender',
        'address',
        'phone',
        'avatar',
        'pelkat',
        'user_id',
    ];
}
