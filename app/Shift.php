<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $guarded = [];

    public function house(){
    	return $this->belongsTo('App\House');
    }
}
