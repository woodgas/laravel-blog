<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class PostCommentsController extends Controller
{
    public function store(Post $post){

        request()->validate([
            'body' => ['required', 'min:10' , 'max:8192'],
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => request()->body
        ]);
       return back()->with('success', 'The comment is added!');
    }
}
