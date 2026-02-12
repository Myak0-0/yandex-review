<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;
    public $fillable = [
        'author',
        'rating',
        'text',
        'date',
        'branch_id'
    ];
}
