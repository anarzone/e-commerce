<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['fullname', 'address1', 'address2', 'city', 'country_code', 'zip_code', 'phone'];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
}
