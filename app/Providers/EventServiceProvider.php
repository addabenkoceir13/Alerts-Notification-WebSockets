<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\UserCreatedEvent::class => [
            \App\Listeners\UserCreatedListener::class,
        ],
        \App\Events\UserApprovedEvent::class => [
            \App\Listeners\UserApprovedListener::class,
        ],
        \App\Events\PostCreatedEvent::class => [
            \App\Listeners\PostCreatedListener::class,
        ],
        \App\Events\PostApprovedEvent::class => [
            \App\Listeners\PostApprovedListener::class,
        ],
    ];

    public function boot(): void {}
}

