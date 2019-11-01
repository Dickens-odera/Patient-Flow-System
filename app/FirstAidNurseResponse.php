<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstAidNurseResponse extends Model
{
    protected $table = 'first_aid_nurse_responses';
    protected $fillable = ['patient','nurse','doctor','status','comments'];
}
