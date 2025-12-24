<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/registration');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $this->withoutExceptionHandling();

        // Ensure no existing registration
        $this->assertDatabaseMissing('registrations', ['user_id' => $user->id]);

        $response = $this->post('/registration', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'photo' => UploadedFile::fake()->image('photo.jpg'),
            'passport_number' => 'A12345678',
            'nationality' => 'Bangladeshi',
            'country' => 'Bangladesh',
            'gender' => 'Male',
            'organization' => 'Test Org',
            'type_of_business' => 'LLC',
            'designation' => 'Developer',
            'website' => 'https://example.com',
            'business_description' => 'Software Development',
            'address_line1' => '123 Test St',
            'city' => 'Test City',
            'state' => 'Test State',
            'zip_code' => '12345',
            'payment_proof' => UploadedFile::fake()->image('payment.jpg'),
            'signature' => UploadedFile::fake()->image('signature.png'),
        ]);

        $this->assertDatabaseHas('registrations', [
            'email' => 'test@example.com',
            'passport_number' => 'A12345678',
            'nationality' => 'Bangladeshi',
            'country' => 'Bangladesh',
            'website' => 'https://example.com',
            'city' => 'Test City',
        ]);

        $registration = \App\Models\Registration::where('email', 'test@example.com')->first();
        Storage::disk('public')->assertExists($registration->photo_path);
        Storage::disk('public')->assertExists($registration->payment_proof_path);
        Storage::disk('public')->assertExists($registration->signature_path);
        
        $response->assertRedirect('/dashboard');
    }
}
