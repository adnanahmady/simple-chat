<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Massege extends Model
{
    protected $fillable = ['from', 'to', 'text'];
}
