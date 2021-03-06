<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Post;

class UserPostController extends Controller
{
    //
    public function index(User $user) {
        $posts= $user->posts()->with(['user', 'likes'])->paginate(5);

        return view('posts.Profile',[
            'user'=>$user,
            'posts'=>$posts
        ]);
    }
}
