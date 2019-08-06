<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class RouteTest extends TestCase
{
    /**
     * Verify redirects happen when not authenticated
     *
     * @return void
     */
    public function testNotAuthRedirect() {
        $this->get('/')
          ->assertRedirect('/login')
          ->assertSee('Redirecting to');
    }
}
