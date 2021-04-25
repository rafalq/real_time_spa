<?php

namespace App\Http\Controllers;

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
    }

    public function unlike(Reply $reply)
    {
        $reply->likes()->where('user_id', auth()->id())->first()->delete();
    }
}
