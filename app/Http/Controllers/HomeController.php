<?php

namespace App\Http\Controllers;

use App\Models\Food\Food;
use App\Models\Food\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breakfast = Food::select()->take(4)
            ->where('category', 'breakfast')->get();
        $lunchFoods = Food::select()->take(4)
            ->where('category', 'launch')->get();
        $dinnerFoods = Food::select()->take(4)
            ->where('category', 'dinner')->get();
        $reviews = Review::all();
        return view('home', compact('breakfast', 'lunchFoods', 'dinnerFoods', 'reviews'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function service()
    {
        return view('pages.services');
    }

     public function contact()
    {
        return view('pages.contact');
    }
}
