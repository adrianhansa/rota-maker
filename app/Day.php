<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Day extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function house()
    {
        return $this->belongsTo('App\House');
    }

    public function employees()
    {
        return $this->belongsToMany('App\Employee')->withPivot('shift_id','date','shift_name','shift_duration');
    }
}
