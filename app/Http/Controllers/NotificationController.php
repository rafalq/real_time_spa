<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    public function index()
    {
        return [
            'read_notifications' => NotificationResource::collection(auth()->user()->readNotifications()->get()),
            'unread_notifications' =>  NotificationResource::collection(auth()->user()->unreadNotifications()->get()),
        ];
    }

    public function markAsRead(Request $request)
    {
        auth()->user()->notifications->where('id', $request->id)->markAsRead();
    }
}
