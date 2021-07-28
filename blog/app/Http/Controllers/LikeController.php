<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request){

        if($post->liked($request->user())){
            return response(null,409);
        }
        $post->likes()->create([
            "user_id" => $request->user()->id, 
        ]);

        return back();
    }
    public function destroy(Post $post, request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
