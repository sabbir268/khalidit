<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sheetWorkers()
    {
        return $this->hasMany('App\SheetWorker');
    }

    
}
