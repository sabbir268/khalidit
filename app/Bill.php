<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['user_id', 'report_url', 'extra_addition', 'extra_addition_comment', 'deduction', 'deduction_comment', 'month', 'total', 'total_lead'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
