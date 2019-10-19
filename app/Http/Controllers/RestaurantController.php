<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Order;
use App\Consumable;
use App\Restaurant;
use Image;
use File;
use Redirect;
use DB;

class RestaurantController extends Controller
{
    public function destroy($id) {
        $restaurant = Restaurant::findOrFail($id);
        $image_path = 'uploads/avatars/'.$restaurant->avatar;

        File::delete($image_path);

        $restaurant->delete();

        return Redirect::back();
    }

    public function store(Request $request) {

        $restaurant = new Restaurant;

        $restaurant->user_id = Auth()->user()->id;
        $restaurant->name = $request->name;
        $restaurant->kvk = $request->kvk;
        $restaurant->zipcode = $request->zipcode;
        $restaurant->city = $request->city;
        $restaurant->phone = $request->phone;
        $restaurant->email = $request->email;
        $restaurant->biography = $request->biography;
        $restaurant->is_open = $request->is_open;
        $restaurant->is_closed = $request->is_closed;

        $restaurant->save();

        return redirect()->back()->with('message', 'Restaurant aangemaakt!!!');
    }

    public function update(Request $request, $id) {
        // return [
        //     'name' => 'required|string|max:50',
        //     'email' => 'required|email|unique:users',
        //     'phone' => 'required|regex:/(01)[0-12]{12}/'
        // ];

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->name = $request->name;
        $restaurant->kvk = $request->kvk;
        $restaurant->zipcode = $request->zipcode;
        $restaurant->city = $request->city;
        $restaurant->phone = $request->phone;
        $restaurant->email = $request->email;
        $restaurant->biography = $request->biography;
        $restaurant->is_open = $request->is_open;
        $restaurant->is_closed = $request->is_closed;

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $destinationPath = public_path('/uploads/avatars/');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            if ($restaurant->avatar !== 'default.png') {
                $file = 'uploads/avatars/' . $restaurant->avatar;
                if (File::exists($file)) {
                    unlink($file);
                }
            }
            Image::make($avatar)->fit(300, 300)->save($destinationPath . $filename);
            $restaurant->avatar = $filename;
        }

        $restaurant->save();

        return Redirect::back();
    }

    public function edit($id) {
        $restaurant = Restaurant::find($id);
        if (Auth::check()) {
             if ($restaurant->user->id === Auth::user()->id) {
                return view('restaurant.edit')
                    ->with('restaurant', $restaurant);
            } else{
                return Redirect::back();            }
        } else{
            return Redirect::back();
        }
    }

    public function show($name) {
        $restaurant = Restaurant::where('name', $name)
        ->FirstOrFail();

        return view('restaurant.restaurant')
        ->with('restaurant', $restaurant);
    }

    public function showAllRestaurants(Restaurant $restaurant) {
        $restaurants = Restaurant::all();

        return view('restaurant.allRestaurants', compact('restaurants'));
    }
}
