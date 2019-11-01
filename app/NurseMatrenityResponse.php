<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NurseMatrenityResponse extends Model
{
    protected $table = 'nurse_maternity_responses';
    protected $fillable = ['patient','nurse','doctor','comments','status'];
}
