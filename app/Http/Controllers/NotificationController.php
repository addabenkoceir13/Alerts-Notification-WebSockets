<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function unreadCount(Request $request)
    {
        return response()->json(['count' => $request->user()?->unreadNotifications()->count() ?? 0]);
    }
    public function list(Request $request)
    {
        $items = $request->user()->notifications()->latest()->limit(30)->get()->map(function ($n) {
            return [
                'id' => $n->id, 
                'category' => $n->data['category'] ?? 'default', 
                'message' => $n->data['message'] ?? $n->type, 'read_at' => $n->read_at, 
                'created_at' => $n->created_at->toDateTimeString()
            ];
        });
        return response()->json(['items' => $items]);
    }
    public function markAsRead(Request $request, $id)
    {
        $n = $request->user()->notifications()->findOrFail($id);
        $n->markAsRead();
        return response()->json(['ok' => true]);
    }
    public function markAllAsRead(Request $request)
    {
        $request->user()->unreadNotifications()->update(['read_at' => now()]);
        return response()->json(['ok' => true]);
    }
}
