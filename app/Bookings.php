<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $table = 'patient_bookings';
    protected $fillable = ['patient','doctor','nurse','date','time','status'];
}
