<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AppTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function test_unauthenticated_users_are_redirected_to_login()
    {
        $response = $this->get('/');
        $response->assertRedirect('login');
    }


    /**
     * @test
     */
    public function test_authenticated_users_are_redirected_to_feedback_add_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get('/');
        $response->assertRedirect('feedback/add');
    }

    public function test_authenticated_user_can_post_feedback()
    {
        $user = User::factory()->create();
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->post('feedback/add', ['text' => 'test feedback', 'title' => 'test feedback title', '_token' => csrf_token()]);
        $response->assertSee('successfully added');
    }

    public function test_authenticated_user_cannot_add_feedback_immediately()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('feedback/add', ['text' => 'test feedback', 'title' => 'test feedback title', '_token' => csrf_token()]);
        $response = $this->followingRedirects()
            ->actingAs($user)
            ->post('feedback/add', ['text' => 'test feedback', 'title' => 'test feedback title', '_token' => csrf_token()]);
        $response->assertStatus(429);
    }

    public function test_authenticated_user_can_upload_files()
    {
        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('attach.jpg');
        $this->actingAs($user)
            ->post('feedback/add', [
                'text' => 'test feedback',
                'title' => 'test feedback title',
                '_token' => csrf_token(),
                'file' => $file
            ]);
        Storage::disk('public')->assertExists($file->hashName());
        Storage::disk('public')->delete($file->hashName());
    }

    public function test_manager_can_see_feedbacks()
    {

        $user = User::factory()->create();
        $this->actingAs($user)
            ->post('feedback/add', ['text' => 'test feedback', 'title' => 'test feedback title', '_token' => csrf_token()]);
        $manager = User::factory()->create();
        $manager->is_manager = true;
        $response = $this->actingAs($manager)
            ->get('manager/feedbacks');
        $response->assertSee('test feedback');
    }

    public function test_manager_can_download_files()
    {
        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('attach.jpg');
        $this->actingAs($user)
            ->post('feedback/add', [
                'text' => 'test feedback',
                'title' => 'test feedback title',
                '_token' => csrf_token(),
                'file' => $file
            ]);
        $response = Http::get(env('APP_URL') . '/storage/' . $file->hashName());
        $this->assertEquals(200, $response->status());
        Storage::disk('public')->delete($file->hashName());
    }

    public function test_manager_cannot_leave_feedback()
    {
        $manager = User::factory()->create();
        $manager->is_manager = true;
        $response = $this
            ->actingAs($manager)
            ->post('feedback/add', ['text' => 'test feedback', 'title' => 'test feedback title', '_token' => csrf_token()]);
        $response->assertStatus(302)
            ->assertRedirect('/');
    }

    public function test_user_cannot_view_feedbacks()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get('manager/feedbacks');
        $response->assertStatus(302)
            ->assertRedirect('/');
    }


}
