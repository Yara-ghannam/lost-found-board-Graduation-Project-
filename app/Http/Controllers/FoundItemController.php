<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Claim;
use App\Models\Item;
use App\Models\Location;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Image;

class FoundItemController extends Controller
{

    public function indexItems()
    {
        $user_id = Session::get('user_id');

        $foundItems = Post::with(['item.category', 'location', 'user','comments.user'])
            ->where('post_type', 'found')
            ->where('case_status', 'open')
            ->orderBy('created_at', 'desc')
            ->get();
        //dd($foundItems);to check data
        $claims = Claim::where('user_id', $user_id);
        $categories = Category::all();

        return view('item.found-items', ['foundItems' => $foundItems, 'claims' => $claims, 'categories' => $categories]);
    }

    public function reportFound()
    {
        $categories = Category::select('id', 'name')->get();

        return view('item.report-found', ['categories' => $categories]);
    }

    public function storeReportFound(Request $request)
    {
        // items table attributes: id, category_id, title, description, color, brand, serial_or_mark, image_url, created_at, updated_at
        // posts table attrubtes: 	id,	user_id, item_id, location_id, case_status, post_type, created_at, updated_at
        // locations table attributes: id, campus, building, room, notes, created_at, updated_at

        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'color' => 'nullable|string|max:50',
            'brand' => 'nullable|string|max:100',
            'serial_or_mark' => 'nullable|string|max:100',
            'campus' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'room' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:500',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        // Handle file upload
        //$imagePath = null;
        if ($request->hasFile('image_url')) {
            $imageName = time() . '.' . $request->image_url->extension();
            $request->image_url->move(public_path('uploads/items'), $imageName);

            // Store the relative path in DB
            $imagePath = 'uploads/items/' . $imageName;
        } else {
            $imagePath = "https://png.pngtree.com/png-clipart/20250121/original/pngtree-flat-image--icon--vector-png-image_4949815.png";
        }


        $item = Item::create([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'color' => $request->input('color'),
            'brand' => $request->input('brand'),
            'serial_or_mark' => $request->input('serial_or_mark'),
            'image_url' =>   $imagePath,
        ]);

        $location = Location::create([
            'campus' => $request->input('campus'),
            'building' => $request->input('building'),
            'room' => $request->input('room'),
            'notes' => $request->input('notes'),
        ]);

        $user_id = session()->get('user_id');
        /*  $item_id = Item::latest()->first()->id;
        $location_id = Location::latest()->first()->id;*/



        $post = Post::create([
            'user_id' => $user_id,
            'item_id' => $item->id,
            'location_id' => $location->id,
            //'case_status' => 'open',
            'post_type' => 'found',
        ]);

        return redirect()->route('found-items')->with('success', 'found item reported successfully!');
    }
}
