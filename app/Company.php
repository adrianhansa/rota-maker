<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function houses()
    {
        return $this->hasMany('App\House');
    }

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
