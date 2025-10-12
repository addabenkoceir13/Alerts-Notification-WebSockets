<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostApprovedEvent implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function broadcastOn(): array
    {
        // Notify the specific user via their private channel if listening to events directly
        return [new PrivateChannel('App.Models.User.' . $this->post->user_id)];
    }

    public function broadcastAs(): string
    {
        return 'post.approved';
    }
}
