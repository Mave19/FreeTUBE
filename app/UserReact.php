<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class UserReact extends Model
{
    protected $table = "userreacts";

    protected $fillable = [
        'email', 'username', 'post_id', 'reaction',
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }
}
