<?php

namespace Amplify\System\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function submitOrder(Request $request)
    {
        // dd($request->all());
        return response()->json([

            'status' => 'OK',
            'redirectURL' => route('api.order.fetch-cart-data'),
        ]);
    }
}
