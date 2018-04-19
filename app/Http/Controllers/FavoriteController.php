<?php

namespace App\Http\Controllers;

use DB;
use App\Reply;
use App\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
      return $this->middleware(['auth']);
    }

    public function store(Request $request, Reply $reply)
    {
      /** Three ways to create it */
      //  DB::table('favorites')->insert([
      //   'user_id' => auth()->id(),
      //   'favorited_id' => $reply->id,
      //   'favorited_type' => get_class($reply)
      // ]);

      // Favorite::create([
      //   'user_id' => auth()->id(),
      //   'favorited_id' => $reply->id,
      //   'favorited_type' => get_class($reply)
      // ]);

      // $reply->favorites()->create(['user_id' => auth()->id()]);


      $reply->favorite();

      return back();
    }

    public function destroy(Request $request, Reply $reply)
    {
      $reply->unfavorite();
    }
}
