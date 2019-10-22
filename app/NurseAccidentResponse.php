<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NurseAccidentResponse extends Model
{
    protected $table = 'nurse_accident_response';
    protected $fillable = [
            'patient','doctor','nurse','comments','accident_type','damage_type'
    ];
}
