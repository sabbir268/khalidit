<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    protected $table = 'sheet';

    public function user_modify(){
        return $this->blongsTo('\App\user','user_modified');
    }
}