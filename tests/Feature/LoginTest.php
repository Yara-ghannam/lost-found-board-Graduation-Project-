<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => '101@aau.edu.jo',
            'password' => Hash::make('12345678'),
        ]);

        $this->assertTrue(
            Hash::check('12345678', $user->password)
        );
    }

    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
