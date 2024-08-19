<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'institution',
        'degree',
        'start_date',
        'end_date'
    ];

   
}
