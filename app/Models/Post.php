<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";

    protected $fillable = ["title", "description", "user_id", 'image'];

//    protected $guarded = ["id"];


    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
