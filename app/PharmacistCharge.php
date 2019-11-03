<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacistCharge extends Model
{
    protected $table = 'pharmacist_charges';
    protected $fillable = ['date','amount','patient','status','comments'];
}
