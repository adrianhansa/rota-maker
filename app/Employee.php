<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function days()
    {
        return $this->belongsToMany('App\Day');
    }

    public function house()
    {
        return $this->belongsTo('App\House')->withPivot('shift_id','date','shift_name','shift_duration');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
