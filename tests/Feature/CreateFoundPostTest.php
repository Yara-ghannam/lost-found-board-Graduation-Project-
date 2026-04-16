<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Post;
use App\Models\Location;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateFoundPostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_found_item_post()
    {
        $user = User::factory()->create();
        session()->put('user_id', $user->id);

        $category = Category::firstOrCreate(['name' => 'Other']);

        $item = Item::create([
            'category_id' => $category->id,
            'title' => 'Lost Phone',
            'description' => 'Black iPhone found near cafeteria',
            'color' => 'Black',
            'brand' => 'Apple',
            'serial_or_mark' => 'SN123456',
            'image_url' => 'uploads/items/test.png',
        ]);

        $location = Location::create([
            'campus' => 'Main Campus',
            'building' => 'IT Building',
            'room' => 'Lab 101',
            'notes' => 'Near the entrance',
        ]);

        $post = Post::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'location_id' => $location->id,
            'post_type' => 'found',
        ]);

        $this->assertDatabaseHas('items', [
            'title' => 'Lost Phone',
            'brand' => 'Apple',
        ]);

        $this->assertDatabaseHas('locations', [
            'campus' => 'Main Campus',
            'building' => 'IT Building',
        ]);

        $this->assertDatabaseHas('posts', [
            'post_type' => 'found',
            'user_id' => $user->id,
        ]);
    }
}
