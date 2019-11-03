<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorAccidentResponse extends Model
{
    protected $table = 'doctor_accident_responses';
    protected $fillable = ['date','pharmacist','prescription','patient','comments','status','admit'];
}
