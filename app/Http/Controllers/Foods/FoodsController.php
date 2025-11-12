<?php

namespace App\Http\Controllers\Foods;

use App\Http\Controllers\Controller;
use App\Models\Food\Booking;
use App\Models\Food\Cart;
use App\Models\Food\Checkout;
use Illuminate\Http\Request;
use App\Models\Food\Food;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FoodsController extends Controller
{
    public function foodDetails($id)
    {
        $foodDetails = Food::findorfail($id);
        if (Auth::user()) {
            
            $cartVerify = Cart::where('food_id', $id)->where('user_id', Auth::user()->id)->count();
            return view('foods.food-details', compact('foodDetails', 'cartVerify'));
        }else {
            return view('foods.food-details', compact('foodDetails'));
        }
    }

    public function cart(Request $request)
    {
        $cart = Cart::create([
            'food_id' => $request->food_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
        ]);
        if ($cart) {
            return redirect()->back()->with('success', 'Food added to cart successfully');
        }
    }


    public function displayCart()
    {
        //display cart items
        $cartItem = Cart::where('user_id', Auth::user()->id)->get();

        //display price total
        $totalPrice = Cart::where('user_id', Auth::user()->id)->sum('price');

        return view('foods.cart', compact('cartItem', 'totalPrice'));
    }

    public function deleteItem($id)
    {
        //display cart items
        $cartItem = Cart::where('food_id', $id)->where('user_id', Auth::user()->id);
        $cartItem->delete();
        if ($cartItem) {
            return redirect()->back()->with('success', 'Item deleted successfully');
        }
    }

    public function prepareCheckout(Request $request)
    {
        $price = Session::put('price', $request->price);
        $newprice = Session::get('price');
        if ($newprice > 0) {
            if (Session::get('price') == 0) {
                abort('403');
            } else {
                return view('foods.checkout', compact('newprice'));
            }
        }
    }

    public function checkout()
    {
        if (Session::get('price') == 0) {
            abort('403');
        } else {
            return view('foods.checkout');
        }
    }

    public function storeCheckout(Request $request)
    {
        $checkout = Checkout::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'country' => $request->country,
            'town' => $request->town,
            'price' => $request->price,
            'address' => $request->address,
            'status' => $request->status,
            'zipcode' => $request->zipcode,
        ]);
        if ($checkout) {
            if (Session::forget('price') == 0) {
                abort('403');
            } else {
                return redirect()->route('payWithPaypal');
            }
        }
    }

    public function payWithPaypal()
    {
        if (Session::forget('price') == 0) {
            abort('403');
        } else {
            return view('foods.pay');
        }
    }

    public function success()
    {
        $cartItem = Cart::where('user_id', Auth::user()->id);
        $cartItem->delete();
        if ($cartItem) {
            if (Session::forget('price') == 0) {
                abort('403');
            } else {
                Session::forget('price');
                return redirect()->route('success')->with('success', 'payment done successfully');
            }
        }
    }

    public function bookingTables(Request $request)
    {
        $currentDate = Carbon::now();
        $requestedDate = Carbon::parse($request->date);

        if ($requestedDate->lessThanOrEqualTo($currentDate)) {
            return redirect()->back()->with('error', 'Date must be in the future');
        }

        $booking = Booking::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'nbr_people' => $request->nbr_people,
            'date' => $request->date,
            'spe_request' => $request->spe_request
        ]);

        if ($booking) {
            return redirect()->back()->with('success', 'you booked a table successfully');
        }
    }


    public function foodMenu()
    {
        $breakfast = Food::select()->take(4)
            ->where('category', 'breakfast')->get();
        $lunchFoods = Food::select()->take(4)
            ->where('category', 'launch')->get();
        $dinnerFoods = Food::select()->take(4)
            ->where('category', 'dinner')->get();

        return view('foods.menu', compact('breakfast', 'lunchFoods', 'dinnerFoods'));
    }
}
