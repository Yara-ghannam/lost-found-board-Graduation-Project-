<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'comment_text' => 'required|min:2'
    ]);

    // إنشاء التعليق
    Comment::create([
        'post_id' => $request->post_id,
        'user_id' => Session::get('user_id'),
        'comment_text' => $request->comment_text,
    ]);

    // جلب البوست مع الـ item
    $post = Post::with('item')->find($request->post_id);

    // جلب اسم الشخص الذي كتب التعليق
    $commenter = User::find(Session::get('user_id'));

    if ($post && $post->user_id != Session::get('user_id')) {
        Notification::create([
            'user_id' => $post->user_id,
            'notification_text' =>
        '"' . ($commenter->name ?? 'Someone') . '" commented on your post: "' . ($post->item->title ?? 'your item') . '"'
        ]);
    }

    return back()->with('success', 'Comment added successfully');
}

}
