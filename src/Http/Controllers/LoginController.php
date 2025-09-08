<?php

namespace Amplify\System\Api\Http\Controllers;

use Amplify\System\Backend\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $contact = Contact::where('email', $request->email)->first();
        Auth::guard('customer')->login($contact);
        if ($contact) {
            $account = customer(true);
            if ($account) {
                if (! $account->hashkey) {
                    $token = Str::random(32);
                    $account->hashkey = $token;
                    $account->save();
                }

                return [
                    'redirect_url' => route('punchout.login').'?auth_key='.$account->hashkey,
                ];

            } else {
                return response()->json('No account Found');
            }
        } else {
            return response()->json('fail');
        }
    }

    public function fetchCartData()
    {
        dd('hi');
    }
}
