<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Question;
use App\Models\Reply;
use App\Http\Requests\CreateReplyRequest;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Events\ReplyAddedEvent;
use App\Events\ReplyDeletedEvent;


class ReplyController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, CreateReplyRequest $request)
    {
        $reply = $question->replies()->create($request->validated());

        $user = $question->user;
        if ($reply->user_id !== $question->user_id) {
            $user->notify(new NewReplyNotification($reply));
        }

        $reply_pusher = new ReplyResource($reply);

        broadcast(new ReplyAddedEvent($reply_pusher))->toOthers();

        return response(['reply' => new ReplyResource($reply)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request, Reply $reply)
    {
        $reply->update($request->all());
        return response('Updated', Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();

        broadcast(new ReplyDeletedEvent($reply->id, 0))->toOthers();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
