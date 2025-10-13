<?php

use Illuminate\Support\Facades\Broadcast;

// Register the broadcasting auth routes for private channels
Broadcast::routes([
    'middleware' => ['web', 'auth'],
]);

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Optional admin-wide channel (used for PostCreatedEvent broadcastAs('post.created'))
Broadcast::channel('admins', function ($user) {
    return $user && method_exists($user, 'isAdmin') && $user->isAdmin();
});
