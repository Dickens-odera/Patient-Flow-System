<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstAid extends Model
{
    protected $table = 'first_aid_requests';
    protected $fillable = ['patient','location','street','description','status'];

}
