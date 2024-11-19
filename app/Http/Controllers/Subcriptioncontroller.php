<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionNotification;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Mail;
use Symfony\Contracts\Service\Attribute\SubscribedService;

class Subcriptioncontroller extends Controller
{ public function show()
    {
        return view('subscribe');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create(['email' => $request->email]);

        // Send confirmation email
        Mail::to($request->email)->send(new SubscriptionNotification($request->email));

        return redirect()->route('subscribe.show')->with('success', 'Thank you for subscribing! Please check your email for confirmation.');
    }
}
