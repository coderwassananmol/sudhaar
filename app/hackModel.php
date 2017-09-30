<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hackModel extends Model
{
    protected $table = 'documentCase';

    protected $fillable = [
        'name','email','category','place','officer','service','case','proof','anonymous','remember_token','created_at','updated_at'
    ];
}
