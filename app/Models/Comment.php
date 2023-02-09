<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $with = ['author'];

    protected $fillable = ['post_id', 'user_id', 'body'];

    public function post() {
      return  $this->belongsTo(Post::class, 'post_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
