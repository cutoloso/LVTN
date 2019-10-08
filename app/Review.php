<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";
    protected $fillable = ["pro_id", "usr_id", "content", "star". "parent"];
}
