<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{

    public function index() {

        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))
                ->where('status', '=', 'published')
                ->paginate(6)
                ->withQueryString(),

            'currentCategory' => Category::firstWhere('slug', '=', request('category')),
        ]);
    }

    public function show(Post $post) {
//        abort_if($post->status == 'draft', 404, "The post didn't find");
//        $comments = $post->comments()->get();
        $hasBookmark = false;
        if($user = auth()->user()) {
            $hasBookmark = !$user->checkBookmark($post->id);
        }

        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()->latest()->paginate(10),
            'hasBookmark' => $hasBookmark,
        ]);
    }

}
