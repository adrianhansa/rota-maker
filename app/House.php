<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function days()
    {
        return $this->hasMany('App\Day');
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function shifts(){
        return $this->hasMany('App\Shift');
    }
}
