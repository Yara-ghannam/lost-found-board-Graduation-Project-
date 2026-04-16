<?php

namespace App\Handlers;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AutoVerificationHandler extends BaseClaimHandler
{
    public function handle($claim)
    {
        $post = $claim->post;

        $item = Item::find($post->item_id);

        // مقارنة الوصف
        similar_text(strtolower($claim->claim_data['description']), strtolower($item->description), $descPercent);

        // مقارنة اللون
        similar_text(strtolower($claim->claim_data['color'] ?? ''), strtolower($item->color ?? ''), $colorPercent);
        // مقارنة الماركة
        similar_text(strtolower($claim->claim_data['brand'] ?? ''), strtolower($item->brand ?? ''), $brandPercent);

        // مقارنة الرقم التسلسلي أو العلامة
        similar_text(strtolower($claim->claim_data['serial_or_mark'] ?? ''), strtolower($item->serial_or_mark ?? ''), $serialPercent);

        // جمع النسب
        $totalPercent = $descPercent + $colorPercent + $brandPercent + $serialPercent;
        //dd($totalPercent);
        // التحقق من الموافقة
        if ($totalPercent >= 50) {
            $claim->verification_status = 'auto_approved';
            $claim->verification_details = "Total match: {$totalPercent}%";
            $claim->save();

            //Session::put("claim_access_{$claim->id}", now()->addHour()->timestamp);

            // i want to add convert verirfiaction_status here

            return "Auto approved: {$totalPercent}% match";
        }

        if ($claim->verification_status === 'auto_approved') {
        $approvedAt = Carbon::parse($claim->updated_at); // وقت آخر تعديل
        if (Carbon::now()->diffInMinutes($approvedAt) >= 60) {
            $claim->verification_status = null;
            $claim->verification_details = null;
            $claim->save();
        }
    }

        return parent::handle($claim);
    }
}
