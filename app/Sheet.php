<?php

namespace App;

use App\LeadTracker;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    protected $guarded = [];
    public $appends = ['collected_lead'];

    

    public function sheetWorkers()
    {
        return $this->hasMany('App\SheetWorker');
    }


    public function getCollectedLeadAttribute()
    {
        $swids = $this->sheetWorkers()->pluck('id')->toArray();
        return LeadTracker::whereIn('sheet_worker_id', $swids)->sum('lead_count');
    }
}
