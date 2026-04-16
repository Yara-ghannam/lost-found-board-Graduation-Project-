<?php

namespace App\Handlers;

use App\Models\Notification;
use App\Models\User;

class AdminReviewHandler extends BaseClaimHandler
{
    public function handle($claim)
    {
        $claim->verification_status = 'pending_admin';
        $claim->verification_details = "Description similarity too low";
        $claim->save();


        // يمكن هنا إرسال إشعار للأدمن
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'notification_text' =>
                'New claim pending admin approval for post: ' . ($claim->post->item->title ?? 'item')
            ]);
        }

        return "Sent to admin for review";
    }
}
