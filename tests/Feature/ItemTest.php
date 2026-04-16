<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_item()
    {
        // Ensure a category exists
        $category = Category::firstOrCreate(['name' => 'Other']);

        // Create the item
        $item = Item::create([
            'category_id' => $category->id,
            'title' => 'Lost Phone',
            'description' => 'Black iPhone found near cafeteria',
            'color' => 'Black',
            'brand' => 'Apple',
            'serial_or_mark' => 'SN123456',
            'image_url' => 'uploads/items/test.png',
        ]);

        $this->assertDatabaseHas('items', [
            'title' => 'Lost Phone',
        ]);
    }
}
