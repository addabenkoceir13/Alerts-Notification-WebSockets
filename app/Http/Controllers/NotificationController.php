<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function unreadCount(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'count' => $user?->unreadNotifications()->count() ?? 0,
        ]);
    }
    public function list(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['items' => []]);
        }

        $items = $user->notifications()
            ->latest()
            ->limit(30)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'category' => $notification->data['category'] ?? 'default',
                    'message' => $notification->data['message'] ?? $notification->type,
                    'read_at' => $notification->read_at?->toDateTimeString(),
                    'created_at' => $notification->created_at->toDateTimeString(),
                ];
            })
            ->values();
        return response()->json(['items' => $items]);
    }
    public function markAsRead(Request $request, $id)
    {
        $user = $request->user();

        if (!$user) {
            abort(404);
        }

        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();
    }
    public function markAllAsRead(Request $request)
    {
       $user = $request->user();

        if (!$user) {
            return response()->json(['ok' => true]);
        }

        $user->unreadNotifications()->update(['read_at' => now()]);
    }
}
