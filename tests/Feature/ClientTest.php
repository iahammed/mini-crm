<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

use App\Models\Client;
use App\Models\User;

class ClientTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test of Client.
     *
     * @return void
     */
    public function test_client_page_auth_check()
    {
        $response = $this->get('/client')->assertStatus(302);
    }

    public function test_unathorize_client_page_redirect_to_login()
    {
        $response = $this->get('/client')->assertRedirect('/login');
    }

    public function test_user_can_create_client()
    {
        $this->withoutExceptionHandling();
        $this->authorize_a_user();
        $attrtibutes = Client::factory()->raw();
        $this->post('/client', $attrtibutes)->assertRedirect('/client');
        $this->assertDatabaseHas('clients', $attrtibutes);
        $this->get('/client')->assertSee($attrtibutes['first_name']);
    }
    
    public function test_create_client_require_fields_validation_check()
    {
        $this->authorize_a_user();
        $this->post('/client', [])->assertSessionHasErrors(['first_name','last_name','email', 'avatar']);
    }

    public function test_admin_can_view_client_detail()
    {
        $this->withoutExceptionHandling();
        $this->authorize_a_user();
        $client = Client::factory()->create();
        $this->get($client->path())
                ->assertSee($client->first_name)
                ->assertSee($client->last_name)
                ->assertSee($client->email)
                ->assertSee($client->avatar);
    }
    /**
     *  Basic function to Authorize a user
     *  
     *  @return void
     */
    public function authorize_a_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
