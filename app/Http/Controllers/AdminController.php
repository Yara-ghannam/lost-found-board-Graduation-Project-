<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index()
    {


        $foundItems = Post::with(['item.category', 'location', 'user', 'comments.user'])
            ->where('post_type', 'found')
            ->orderBy('created_at', 'desc')
            ->get();
        $lostItems = Post::with(['item.category', 'location', 'user', 'comments.user'])
            ->where('post_type', 'lost')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', ['foundItems' => $foundItems, 'lostItems' => $lostItems]);
    }

    public function showUsers()
    {


        $admins = User::where('role', 'admin')->get();
        $users = User::where('role', 'user')->get();

        return view('admin.Show-users', compact('admins', 'users'));
    }

    public function deleteUser($id)
    {

        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }

    public function toggleStatus($id)
    {
        $post = Post::findOrFail($id);

        // Toggle status
        $post->case_status = $post->case_status === 'open' ? 'close' : 'open';
        $post->save();

        return redirect()->back()->with('success', 'Case status updated successfully!');
    }

    public function claims()
    {
        $claims = Claim::with([
            'user',          // claimer
            'post.user',     // owner
            'post.item'
        ])
            ->where('verification_status', 'pending_admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.claims', compact('claims'));
    }

    public function approve($claimId, $userId)
    {
        $claim = Claim::where('id', $claimId)
            ->where('user_id', $userId)   // التأكد من الـ claimer
            ->firstOrFail();

        $claim->update([
            'verification_status' => 'auto_approved',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Claim approved successfully.');
    }


    public function reject($claimId, $userId)
    {
        $claim = Claim::where('id', $claimId)
            ->where('user_id', $userId)   // التأكد من الـ claimer
            ->firstOrFail();

        $claim->update([
            'verification_status' => 'rejected',
        ]);

        return redirect()
            ->back()
            ->with('error', 'Claim rejected.');
    }
}
