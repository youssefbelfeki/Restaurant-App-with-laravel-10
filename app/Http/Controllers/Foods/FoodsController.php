<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Models\Food\Cart;
use Illuminate\Http\Request;
use App\Models\Food\Food;
use Illuminate\Support\Facades\Auth;

class FoodsController extends Controller
{
    public function foodDetails($id)
    {
        $foodDetails= Food::findorfail($id);
        $cartVerify= Cart::where('food_id',$id)->where('user_id', Auth::user()->id)->count();       
        return view('foods.food-details',compact('foodDetails','cartVerify'));
    }

    public function cart(Request $request)
    {
        $cart= Cart::create([
            'food_id'=>$request->food_id,
            'user_id'=>$request->user_id,
            'name'=>$request->name,
            'price'=>$request->price,
            'image'=>$request->image,
        ]);
        if($cart){
            return redirect()->back()->with('success','Food added to cart successfully');
        }
    }


    public function displayCart()
    {
        //display cart items
        $cartItem= Cart::where('user_id', Auth::user()->id)->get();   
        
        //display price total
        $totalPrice= Cart::where('user_id', Auth::user()->id)->sum('price');

        return view('foods.cart',compact('cartItem','totalPrice'));
    }

    public function deleteItem($id)
    {
        //display cart items
        $cartItem= Cart::where('food_id',$id)->where('user_id', Auth::user()->id); 
        $cartItem->delete();
        if($cartItem){
            return redirect()->back()->with('success','Item deleted successfully');
        }
    }
}
