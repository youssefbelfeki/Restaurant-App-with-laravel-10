<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Food\Booking;
use App\Models\Food\Checkout;
use App\Models\Food\Food;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewLogin()
    {
        return view('admins.login');
    }

    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')
            ->attempt(
                [
                    'email' => $request->input("email"),
                    'password' => $request->input("password")
                ],
                $remember_me
            )
        ) {

            return redirect()->route('dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function dashboard()
    {
        $foodCount = Food::count();
        $checkoutCount = Checkout::count();
        $bookingCount = Booking::count();
        $adminCount = Admin::count();
        return view('admins.dashboard', compact('foodCount', 'checkoutCount', 'bookingCount', 'adminCount'));
    }

    public function allAdmin()
    {
        $admins = Admin::orderby('id', 'desc')->get();
        return view('admins.all-admins', compact('admins'));
    }

    public function newAdmin()
    {
        return view('admins.newAdmin');
    }

    public function createNewAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> bcrypt($request->password),
        ]);
        if ($admin) {

            return redirect()->route('allAdmin')->with(['success' => 'New admin created successfully']);
        }
    }
}
