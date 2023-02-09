<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class AdminPostController extends Controller
{
    public function index() {
       return view('admin.posts.index', [
           'posts' => Post::latest()->paginate(50),
//           TO Do - make a pagination section at the admin.posts.index page
       ]);
    }

    public function create() {

        return view('admin.posts.create');
    }

    public function store(Request $request) {

        $attributes = $this->validatePost();

        $attributes['user_id'] = auth()->user()->id;
        $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');

        Post::create($attributes);
//        Auth::user()->posts()->create($attributes);
        return redirect('/post/'.$attributes['slug'])->with('success', 'The new post has been added!');
    }

    public function edit(Post $post) {
        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }
    public function update(Post $post, Request $request) {

        $attributes = $this->validatePost($post);

        if($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }
//        The next statement changes the post Author to the current,
//        authenticated user with post manipulate privileges (admin).
//        $attributes['user_id'] = auth()->user()->id;

        $post->update($attributes);

        return redirect('admin/posts')->with('success', 'Post: "'.$post->title.'" updated!');

    }

    public function destroy(Post $post) {
        $post->delete();
        return back()->with('success', 'Post Deleted');
    }


    protected function validatePost(Post $post = null) {

        $request = request();
        $request->mergeIfMissing(['user_id' => $request->user()->id]);

        return request()->validate([
            'title' => ['required','min:5', 'max:1024'],
            'slug' => ['required', 'min:5', 'max:1024', Rule::unique('posts', 'slug')->ignore($post)],
            'thumbnail' => is_null($post) ? ['required', 'image'] : ['image'],
            'excerpt' => ['required','min:5', 'max:8192'],
            'body' => ['required','min:5'],
            'status' => ['required', 'in:draft,published'], // Rule::in(['draft', 'published'])
            'category_id' => ['required', 'exists:categories,id'],
            'user_id' => ($request->input('author_id') == $request->user()->id) ?
                            ['required'] : ['required','exists:users,id'],
        ]);
    }

}
