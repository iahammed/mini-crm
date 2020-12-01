<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class DashboardTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unauthorize_access_to_dashboard()
    {
        $this->get('/dashboard')->assertStatus(302);
    }
    public function test_unauthorize_access_to_dashboard_redirect_to_login()
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }
    public function test_authorize_access_to_dashboard()
    {
        $this->actingAs(User::factory()->create());
        $this->get('/dashboard')->assertStatus(200);
    }

}
