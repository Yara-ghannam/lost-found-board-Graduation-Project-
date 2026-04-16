<?php

namespace App\Http\Controllers;

use App\Handlers\AutoVerificationHandler;
use App\Handlers\AdminReviewHandler;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function store(Request $request)
    {
        $claim = Claim::updateOrCreate(
            [
                'post_id' => $request->post_id,
                'user_id' => session()->get('user_id')
            ],
            [
                'claim_data' => [
                    'description'     => $request->description,
                    'color'           => $request->color,
                    'brand'           => $request->brand,
                    'serial_or_mark'  => $request->serial_or_mark,
                ]
            ]
        );


        // إنشاء Handlers
        $auto = new AutoVerificationHandler();
        $admin = new AdminReviewHandler();

        // ربط السلسلة
        $auto->setNext($admin);

        // تنفيذ الـ Chain
        $result = $auto->handle($claim);

        return back()->with('message', $result);
    }
}
