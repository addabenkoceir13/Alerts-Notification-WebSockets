<?php

namespace App\Http\Controllers\User;

use App\Events\PostCreatedEvent;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('users.posts.index', compact('posts'));
    }
    public function create()
    {
        return view('users.posts.create');
    }
    public function store(Request $request)
    {

        $post = Post::create([
            'title' => 'test 02113', 
            'body' => 'test hjzsbdhhs', 
            'user_id' => 3, 
            'status' => 'pending'
        ]);

        event(new PostCreatedEvent($post));

        return redirect([PostController::class, 'index'])->with('status', 'Post created.');
    }
}
