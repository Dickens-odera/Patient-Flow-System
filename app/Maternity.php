<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maternity extends Model
{
    protected $table = 'maternity_request';
    protected $fillable = ['patient','location','street','description','status'];
}
