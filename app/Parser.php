<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parser extends Model
{
    protected $fillable = [
        'name', 'price'
    ];

    protected $hidden = [
       'remember_token',
    ];
}
