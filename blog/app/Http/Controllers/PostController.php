<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comments;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = post::orderBy('created_at', 'Desc')->with(['user', 'likes'])->paginate(12); //Or you can work with latest() to make posts in desc order

        $commentt = [];
        $max=sizeof($posts);

        for($i=0;$i<$max; $i++){
            $comment_count = Comments::where('post_id', $posts[$i]->id)->count();
            $commentt[$posts[$i]->id] = $comment_count;
        }

        return view('posts.index', [
            'posts' => $posts,
            'comments' => $commentt
        ]);
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }


    public function destroy(Post $post)
    {
        if(auth()->user()->role===1){
            $post->delete();
        }else{
        $this->authorize('delete', $post);

        $post->delete();
        }

        return back();
    }

    public function edit($id)
    {
        $posts = Post::all()->where('id', $id);

        return view('posts.edit', [
            'posts' => $posts
        ]);
    }
    public function update(Request $request, Post $posts)
    {

        $data = $this->validate($request, [
            'body' => 'required'
        ]);
        $request->user()->posts()->update($request->only('body'));
        return redirect()->route('posts');
    }
}
