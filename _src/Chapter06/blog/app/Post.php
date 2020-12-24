<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['content', 'title', 'status', 'user_id'];

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
