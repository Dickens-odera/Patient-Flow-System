<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accidents extends Model
{
    protected $table = 'accidents';
    protected $fillable = ['patient','location','street','description'];
}
