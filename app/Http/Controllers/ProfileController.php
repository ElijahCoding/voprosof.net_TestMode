<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
      // $activities = $user->activity()->with('subject')->get();
      
      return view('profiles.show', [
        'profileUser' => $user,
        // 'activities' => $activities
        'activities' => Activity::feed($user)
      ]);
    }
}
