<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $user_id = session()->get('user_id');
        //  $user_id = session()->get('name');
        //$user_id = session()->get('email');
        //dd($user_id);
        $foundItems = Post::with(['item.category', 'location'])
            ->where('user_id', $user_id)
            ->where('post_type', 'found')
            ->where('case_status', 'open')
            ->orderBy('created_at', 'desc')
            ->get();

        $lostItems = Post::with(['item.category', 'location'])
            ->where('user_id', $user_id)
            ->where('post_type', 'lost')
            ->where('case_status', 'open')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('item.my-posts', [
            'foundItems' => $foundItems,
            'lostItems' => $lostItems,
        ]);
    }

    public function DeletePost($id)
    {
        $post = Post::find($id);
        // $post->case_status = 'closed';
        $item_id = Post::find($id)->item_id;
        $item = Item::find($item_id);
        if (!$post) {
            return redirect()->back()->with('error', 'the post not found');
        } else {
            $post->delete();
            $item->delete();
        }
        return redirect()->back()->with('success', 'the post deleted successfully');
    }

    public function editPost($id = null) // id for post
    {
        //$categories = null;

        $post = Post::with('item.category', 'location')->find($id);
        $post_type = $post->post_type;
        // dd($post);
        $categories = Category::all();

        return view('item.edit-post', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::with('item', 'location')->findOrFail($id);

        // Update Item
        $post->item->title = $request->input('title');
        $post->item->category_id = $request->input('category_id');
        $post->item->description = $request->input('description');
        $post->item->color = $request->input('color');
        $post->item->brand = $request->input('brand');
        $post->item->serial_or_mark = $request->input('serial_or_mark');

        // Handle Image Upload
        if ($request->hasFile('image_url')) {
            $imageName = time() . '.' . $request->image_url->extension();
            $request->image_url->move(public_path('uploads/items'), $imageName);

            $post->item->image_url = 'uploads/items/' . $imageName;
        }

        /*else{
            $post->item->image_url = "https://png.pngtree.com/png-clipart/20250121/original/pngtree-flat-image--icon--vector-png-image_4949815.png";
        }*/


        $post->item->save();  // <-- Save item



        // Update Location
        $post->location->campus = $request->input('campus');
        $post->location->building = $request->input('building');
        $post->location->room = $request->input('room');
        $post->location->notes = $request->input('notes');
        $post->location->save();  // <-- Save location




        if ($request->has('case_status')) {
            $post->case_status = $request->case_status;
        }

        $post->save(); // <-- Save main post record also!

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }
}
