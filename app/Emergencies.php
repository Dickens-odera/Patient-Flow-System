<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emergencies extends Model
{
    protected $table = 'emergencies';
    protected $fillable = [
        'patient_name',
        'type',
        'location',
        'street',
        'address',
        'phone',
        'gender',
        'status',
        'comments'
    ];
}
