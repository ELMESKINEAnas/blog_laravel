<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Post $posts)
    {
        $comments = Comments::all()->where('post_id', $posts->id);
        return view(
            'posts.comment',
            [
                'comments' => $comments
            ]
        );
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'comments' => 'required'
        ]);

        $request->user()->comments()->create([
            'comments' => $request->comments,
            'post_id' => $request->id_post,
        ]);

        return back();
    }


    // public function destroy(Comments $comments)
    // {

    //     $this->authorize('ciggy', $comments);

    //     $comments->delete();

    //     return back();
    // }
}
