<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'workers';

    protected $fillable = [
        'name','code','price','user_modified','status'
    ];

    public function user_modify(){
        return $this->belongsTo('App\User', 'user_modified');
    }
}