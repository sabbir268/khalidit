<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SheetWorker extends Model
{
    protected $guarded = [];

    public function sheet()
    {
        return $this->belongsTo('App\Sheet');
    }
}
