<?php

namespace App\Services\Payments;

use Carbon\Carbon;
use App\Models\Payment;
use Stripe\StripeClient;
use App\Models\Subscription;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class StripePayments
{
    public function createCheckoutSession(Subscription $subscription): Response
    {
        $stripe = App::make(StripeClient::class);

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $subscription->plan->name,
                        ],
                        'unit_amount' => $subscription->plan->price * 100,
                    ],
                    'quantity' => $subscription->expires_at->diffInMonths($subscription->created_at),
                ],
            ],
            'client_reference_id' => $subscription->id,
            'metadata' => [
                'subscription' => $subscription->id,
            ],
            'mode' => 'payment',
            'success_url' => route('payments.success', $subscription->id),
            'cancel_url' =>  route('payments.cancle', $subscription->id),
        ]);

        Payment::forceCreate([
            'user_id' => Auth::id(),
            'subscription_id' => $subscription->id,
            'amount' => $subscription->price * 100,
            'currency_code' => 'usd',
            'payment_gateway' => 'stripe',
            'gateway_reference_id' => $checkout_session->id,
            'data' => $checkout_session,
        ]);

        return redirect()->away($checkout_session->url);
    }
}
