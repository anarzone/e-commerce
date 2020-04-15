<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = ['name', 'app_code'];

    public function users(){
        return $this->belongsToMany('App\User', 'vendor_user');
    }

}
