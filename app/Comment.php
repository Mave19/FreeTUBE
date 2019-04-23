<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Comment extends Model
{
    protected $table = "comments";

    protected $fillable = [
        'username', 'post_id', 'comment'
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
