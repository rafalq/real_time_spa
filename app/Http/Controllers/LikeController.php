<?php

namespace App\Http\Controllers;

use App\Events\ReplyLikedEvent;
use App\Models\Like;
use App\Models\Reply;


class LikeController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function like(Reply $reply)
    {
        $reply->likes()->create([
            'user_id' => auth()->id()
        ]);

        broadcast(new ReplyLikedEvent($reply->id, 1))->toOthers();
    }

    public function unlike(Reply $reply)
    {
        $reply->likes()->where('user_id', auth()->id())->first()->delete();

        broadcast(new ReplyLikedEvent($reply->id, 0))->toOthers();
    }
}
