<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function normal_users_cannot_view_administration_page()
    {
      $this->withExceptionHandling();

      $this->signIn(create('App\User', ['admin' => false]));

      $user = create('App\User', ['admin' => false]);

      $this->get('/admin/users')
           ->assertRedirect('/threads');
    }

    /** @test */
    public function administrator_can_view_administration_page()
    {
      $this->signIn(create('App\User', ['admin' => true]));

      $this->get('/admin/users')
           ->assertSee(auth()->user()->name)
           ->assertStatus(200);
    }
}
