<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_channel_has_many_threads()
    {
      $channel = create('App\Channel');
      $thread = create('App\Thread', ['channel_id' => $channel->id]);

      $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $channel->threads);
      $this->assertTrue($channel->threads->contains($thread));
    }
}
