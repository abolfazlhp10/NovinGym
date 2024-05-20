<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{

    public function index()
    {
        return Subscription::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'price' => ['required'],
            'program_numbers' => ['required']
        ]);

        Subscription::create([
            'price' => $request->price,
            'program_numbers' => $request->program_numbers
        ]);

        return response()->json(['message' => 'subscription paln added successfully'], 201);
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return response()->json(['subscription deleted successfully']);
    }
}

