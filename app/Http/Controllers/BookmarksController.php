<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\Post;

class BookmarksController extends Controller
{
    public function index() {

        return view('account.bookmarks',[
            'bookmarks' => auth()->user()->bookmarks,
        ]);
    }

    public function store($slug) {
        $user = auth()->user();
        $post = Post::whereSlug($slug)->get();

        if($user->checkBookmark($post[0]->id)) {
            Bookmark::create(['post_id' => $post[0]->id, 'user_id' => $user->id ]);
        }
        return back()->with('success', 'Bookmark is created');
    }

    public function destroy($slug) {
        $user = auth()->user();
        $post = Post::whereSlug($slug)->get();

        if(!$user->checkBookmark($post[0]->id)) {
            Bookmark::where([
                'user_id' => $user->id,
                'post_id' => $post[0]->id,
            ])->delete();
        }
        return back()->with('success', 'Bookmark is deleted');
    }

}
