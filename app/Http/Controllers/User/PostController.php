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
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);

        $post = Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'user_id' => (int) $request->user()->id,
            'status' => 'pending',
        ]);

        event(new PostCreatedEvent($post->fresh('user')));

        return redirect()->route('users.posts.index')->with('status', 'Post created.');
    }
}
