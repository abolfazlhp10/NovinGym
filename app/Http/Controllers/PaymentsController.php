<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Payment;
use App\Models\Subscription;
use App\Pay\zarinpal;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function request($sub_id, $username)
    {

        $subscription = Subscription::find($sub_id);


        if (!$subscription) {
            return response()->json(['message' => 'Bad Request'], 400);
        }

        $user = Coach::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'Bad Request'], 400);
        }


        $MerchantID     = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount         = $subscription->price;
        $Description     = "افزودن " . $subscription->program_numbers . " برنامه به حساب کاربری";
        $Mobile         = $user->number;
        $Email             = "";
        $CallbackURL     = route('verify', [$sub_id, $username]);
        $ZarinGate         = false;
        $SandBox         = true;

        $zp     = new zarinpal();
        $result = $zp->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            // Success and redirect to pay
            $zp->redirect($result["StartPay"]);
        } else {
            // error
            echo "خطا در ایجاد تراکنش";
        }
    }

    public function verify($sub_id, $username)
    {

        $subscription = Subscription::find($sub_id);


        if (!$subscription) {
            return response()->json(['message' => 'Bad Request'], 400);
        }

        $user = Coach::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'Bad Request'], 400);
        }


        $MerchantID     = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount         = $subscription->price;
        $ZarinGate         = false;
        $SandBox         = true;

        $zp     = new zarinpal();
        $result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            // Success

            Payment::create([
                'coach_id' => $user->id,
                'subscription_id' => $sub_id
            ]);

            $user->remain_programs += $subscription->program_numbers;
            $user->save();

            return response()->json(['message' => 'successfull payment']);
        } else {
            // error
            return response()->json(['message' => 'payment failed'], 400);
        }
    }
}
