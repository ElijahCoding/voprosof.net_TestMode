<?php

namespace App\Http\Controllers\Api;

use App\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThreadController extends Controller
{
    public function index()
    {
      $threads = Thread::with(['replies', 'creator', 'channel'])->orderBy('created_at', 'desc')->paginate(10);

      return response()->json($threads);
    }
}
