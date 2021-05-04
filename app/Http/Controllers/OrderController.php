<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Order;
use App\Product;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required|int|min:1',
        ]);
        
        if ($validator->fails()) {
            $msg = $validator->errors()->first();
            return response()->json(['message' => $msg], 400 );
        }

        $checkStock = Product::findOrFail( $request->product_id );
        if( $checkStock->available_stock > 0 && $request->quantity <= $checkStock->available_stock )
        {
            $order = new Order([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
    
            $order->save();

            $checkStock->available_stock = $checkStock->available_stock - $request->quantity;
            $checkStock->update();    
                
            return response()->json(['message' => 'You have successfully ordered this product'], 201 );
        }
        else
        {
            return response()->json(['message' => 'Failed to order this product due to unavailability of the stock'], 400 );
        }

        
    }
}
