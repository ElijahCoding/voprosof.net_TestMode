<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function store($channel, Thread $thread)
    {
      $this->validate(request(), ['body' => 'required']);

      $thread->addReply([
        'body' => request('body'),
        'user_id' => auth()->id()
      ]);

      return back()
             ->with('flash', 'Your reply has been left.');
    }

    public function update(Reply $reply)
    {
      $this->authorize('update', $reply);

      $this->validate(request(), ['body' => 'required']);

      $reply->update(request(['body']));
    }

    public function destroy(Reply $reply)
    {
      $this->authorize('update', $reply);

      $reply->delete();

      if (request()->expectsJson()) {
        return response(['status' => 'Reply deleted']);
      }

      return back()->with('flash', 'You have deleted reply successfully.');
    }
}
