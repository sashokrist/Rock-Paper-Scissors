<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected  $table = 'games';
    protected $fillable = ['name', 'item', 'computer', 'win'];
}
