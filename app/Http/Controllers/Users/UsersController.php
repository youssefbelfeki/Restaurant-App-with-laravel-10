<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Food\Booking;
use App\Models\Food\Checkout;
use App\Models\Food\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getBooking()
    {
        $allBookings = Booking::where('user_id',Auth::user()->id)->get();
        return view('users.bookings', compact('allBookings'));
    }

     
    public function getOrders()
    {
        $allOrders = Checkout::where('user_id',Auth::user()->id)->get();
        return view('users.orders', compact('allOrders'));
    }

    public function viewReview()
    {
        return view('users.writeReview');
    }

    public function storeReview(Request $request)
    {
        $request->validate([
                'name' => 'required|max:40',
                'review' => 'required|max:200',
            ]);

         $review = Review::create([
            'name' => $request->name,
            'review' => $request->review,
        ]);
        if ($review) {
            return redirect()->route('home')->with('success', 'Review added successfully');
        }
    }
}
