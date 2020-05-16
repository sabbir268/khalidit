<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ["name", "phone", "gd_phone", "email", "fb_link", "pr_address", "cr_address", "study", "ssc_batch", "online_experience", "dob", "misc", "doc", "user_id", "photo"];
}
