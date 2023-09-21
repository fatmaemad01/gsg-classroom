<?php

namespace App\Http\Controllers;

use App\Actions\CreateSubscrpition;
use App\Http\Requests\CreateSubscrpitionRequest;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Throwable;

class SubscriptionsController extends Controller
{
    public function store(CreateSubscrpitionRequest $request, CreateSubscrpition $create)
    {
        // $request->validate([
        //     'plan_id' => 'required|int',
        //     'period' => 'required|int|min:1'
        // ]);

        $plan = Plan::findOrFail($request->post('plan_id'));
        $months = $request->post('period');
        
        try {
           $subscrpition  = $create([
                'plan_id' => $plan->id,
                'user_id' => $request->user()->id,
                'price' => $plan->price * $months,
                'expires_at' => now()->addMonth($months),
            ]);

            return redirect()->route('checkout', $subscrpition->id );

        } catch (Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
