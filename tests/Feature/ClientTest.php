<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        $response = $this->get(route('client.index'))->assertStatus(302);
    }

    public function test_unathorize_client_page_redirect_to_login()
    {
        $response = $this->get(route('client.index'))->assertRedirect('/login');
    }

    // public function test_avatar_upload()
    // {
    //     Storage::fake('avatars');
    //     $file = UploadedFile::fake()->image('avatar.jpg');
    //     $response = $this->json('POST', '/client', [
    //         'avatar' => $file,
    //     ]);
    //     // Assert the file was stored...
    //     Storage::disk('avatars')->assertExists($file->hashName());
    //     // Assert a file does not exist...
    //     Storage::disk('avatars')->assertMissing('missing.jpg');
    // }

    public function test_admin_user_can_create_client()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $attrtibutes = Client::factory()->raw(
            ['avatar' => $this->faker->image('public/storage/avatars',200,200, null, false)]
        );
        $attrtibutes = Client::factory()->raw();
        $returnedData = $this->post(route('client.store'), $attrtibutes);
        $this->assertDatabaseHas('clients',$returnedData);
        $this->get(route('client.index'))->assertSee($attrtibutes['first_name']);
    }
    
    public function test_create_client_require_fields_validation_check()
    {
        $this->actingAs(User::factory()->create());
        $this->post(route('client.store'), [])->assertSessionHasErrors(['first_name','last_name','email', 'avatar']);
    }
    public function test_create_client_email_field_validation_check()
    {
        $this->actingAs(User::factory()->create());
        $this->post(route('client.store'), Client::factory()->raw(['email'=>'email:rfc,dns']))->assertSessionHasErrors(['email']);
    }

    public function test_create_client_unique_email_field_validation_check()
    {
        $this->actingAs(User::factory()->create());
        $this->post(route('client.store'), Client::factory(2)->raw(['email'=>'xyz@example.com']))->assertSessionHasErrors(['email']);
    }

    public function test_admin_can_view_client_detail()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $client = Client::factory()->create();
        $this->get($client->path())
                ->assertSee($client->first_name)
                ->assertSee($client->last_name)
                ->assertSee($client->email);
    }

    public function test_auth_admin_can_delete_a_client()
    {
        $this->actingAs(User::factory()->create());
        $attrtibutes = Client::factory()->raw();
        $this->post(route('client.store'), $attrtibutes);
        $client = Client::firstOrFail();
        $this->assertCount(1, Client::all());
        $this->delete(route('client.destroy', $client->id));
        $this->assertCount(0, Client::all());
    }

    public function test_auth_admin_can_update_a_client()
    {
        $this->actingAs(User::factory()->create());
        $attrtibutes = Client::factory()->raw();
        $this->post(route('client.store'), $attrtibutes);
        $client = Client::firstOrFail();
        $this->assertCount(1, Client::all());
        
        $this->put(route('client.update', $client->id), [
            'first_name' => 'Iftakher',
            'last_name'  => 'Ahammed',
            'email'      => 'iahammed@gmail.com'
        ]);        
        
        $this->assertEquals('Iftakher', Client::first()->first_name);
        $this->assertEquals('Ahammed', Client::first()->last_name);
        $this->assertEquals('iahammed@gmail.com', Client::first()->email);
    }



}
