<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Events\PostApprovedEvent;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admins.posts.index', compact('posts'));
    }

    public function approve(Post $post)
    {
        if ($post->status !== 'approved') {
            $post->forceFill(['status' => 'approved'])->save();
            event(new PostApprovedEvent($post->fresh('user')));
        }
        return back()->with('status', 'Post approved');
    }
}
