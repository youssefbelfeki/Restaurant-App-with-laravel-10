<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Food\Booking;
use App\Models\Food\Checkout;
use App\Models\Food\Food;
use Illuminate\Support\Facades\File;
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
            'password' => bcrypt($request->password),
        ]);
        if ($admin) {

            return redirect()->route('allAdmin')->with(['success' => 'New admin created successfully']);
        }
    }

    public function allOrders()
    {
        $getAllChekout = Checkout::orderby('id', 'desc')->get();
        return view('admins.all-orders', compact('getAllChekout'));
    }

    public function EditOrder($id)
    {
        $Order = Checkout::findOrFail($id);
        return view('admins.editorder', compact('Order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $Order = Checkout::findOrFail($id);
        $Order->update($request->all());

        if ($Order) {
            return redirect()->route('allOrders')->with(['success' => 'Order Updated successfully']);
        }
    }

    public function DeleteOrder($id)
    {
        $Order = Checkout::findOrFail($id);
        $Order->delete();
        if ($Order) {
            return redirect()->route('allOrders')->with(['success' => 'Order deleted successfully']);
        }
    }

    public function allBooking()
    {
        $getAllBooking = Booking::orderby('id', 'desc')->get();
        return view('admins.all-booking', compact('getAllBooking'));
    }

    public function allFoods()
    {
        $allFoods = Food::orderby('id', 'desc')->get();
        return view('admins.all-food', compact('allFoods'));
    }

    public function createFood()
    {
        return view('admins.create-order');
    }

    public function storeFood(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $destinationPath = 'img/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);
        $food = Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $myimage,
        ]);
        if ($food) {
            return redirect()->route('allFoods')->with(['success' => 'Food Added successfully']);
        }
    }

    public function DeleteFood($id)
    {
        $food = Food::findOrFail($id);
        if (File::exists(public_path('img/' . $food->image))) {
            File::delete(public_path('img/' . $food->image));
        } else {
            //dd('File does not exists.');
        }
        $food->delete();
        if ($food) {
            return redirect()->route('allFoods')->with(['success' => 'Food deleted successfully']);
        }
    }
}
