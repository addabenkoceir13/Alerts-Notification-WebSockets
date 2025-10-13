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
        // Notify specific user and also admins for table sync
        return [
            new PrivateChannel('App.Models.User.' . $this->post->user_id),
            new PrivateChannel('admins'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'post.approved';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->post->id,
            'title' => $this->post->title,
            'body' => $this->post->body,
            'status' => $this->post->status,
            'user_id' => $this->post->user_id,
            'author' => optional($this->post->user)->name,
            'updated_at' => optional($this->post->updated_at)->toDateTimeString(),
        ];
    }
}
