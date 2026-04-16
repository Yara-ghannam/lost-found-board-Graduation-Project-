<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_update_profile_information()
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
        ]);

        $user->update([
            'name' => 'New Name',
            'email' => 'new@email.com',
            'phone' => '0790000000',
        ]);

        $this->assertEquals('New Name', $user->fresh()->name);
        $this->assertEquals('new@email.com', $user->fresh()->email);
    }
}
