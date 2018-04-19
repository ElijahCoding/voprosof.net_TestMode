<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function index()
    {
      $users = User::
      with(['threads', 'threads.replies'])
      ->orderBy('created_at', 'desc')
      ->paginate(10);

      return view('admin.users', compact('users', 'columns'));
    }
}
