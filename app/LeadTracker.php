<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadTracker extends Model
{
    protected $guarded = [];

    public function setEarnAttribute($value)
    {
        $this->attributes['earn'] = $this->sheetWorker->rate * $this->lead_count;
    }

    public function sheetWorker()
    {
        return $this->belongsTo('App\SheetWorker');
    }
}
