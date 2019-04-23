<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Post extends Model
{
    protected $table = "posts";

    protected $fillable = [
        'username', 'email', 'title', 'description', 'file_upload'
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
