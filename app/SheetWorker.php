<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SheetWorker extends Model
{
    protected $guarded = [];
    public $appends = ['name', 'code'];

    public function sheet()
    {
        return $this->belongsTo('App\Sheet');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function getCodeAttribute()
    {
        return $this->user->code;
    }

    public function leadTrakers()
    {
        return $this->hasMany('App\LeadTracker');
    }
}
