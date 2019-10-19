<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Restaurant;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Restaurant $restaurant) {
        $restaurants = Restaurant::where('is_open', '<', date('H:i:s'))
        ->where('is_closed', '>', date('H:i:s'))->get()->random(4);

        return view('home', compact('restaurants'));
    }

    public function index2(Restaurant $restaurant) {
        $restaurants = Restaurant::where('is_open', '<', date('H:i:s'))
        ->where('is_closed', '>', date('H:i:s'))->get()->random(4);

        return view('home', compact('restaurants'));
    }

    public function showprofile($id) {
        $user = User::where('id', $id)
        ->FirstOrFail();

        return view('profile')
        ->with('user', $user);
    }
}
