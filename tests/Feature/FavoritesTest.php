<?php

namespace Tests\Feature;

use Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_can_not_favorite_anything()
    {
      $this->withExceptionHandling();

      $reply = create('App\Reply');

      $this->post('replies/' . $reply->id . '/favorites')
           ->assertRedirect('/login');

    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply'); // automatically generating a thread . Read ModelFactory.php

        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_can_unfavorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply'); // automatically generating a thread . Read ModelFactory.php

        $reply->favorite();
        // $this->post('replies/' . $reply->id . '/favorites');
        $this->assertCount(1, $reply->favorites);

        $reply->unfavorite();
        // $this->delete('replies/' . $reply->id . '/favorites');
        $this->assertCount(0, $reply->fresh()->favorites);
    }

    /** @test */
    public function an_authenticated_user_may_only_favorite_a_reply_once()
    {
      $this->signIn();

      $reply = create('App\Reply');

      try {
        $this->post('replies/' . $reply->id . '/favorites');
        $this->post('replies/' . $reply->id . '/favorites');
      } catch (Exception $e) {
        $this->fail('Did not expect to insert the same record set twice.');
      }

      $this->assertCount(1, $reply->favorites);
    }
}
