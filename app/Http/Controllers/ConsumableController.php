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

class ConsumableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::with('consumables')->findOrFail($restaurantId);

        return view('restaurant.restaurant')
            ->with('restaurant', $restaurant);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string',
            'category' => 'required',
            'avatar' => 'mimes:jpeg,png|max: 10240',

        ]);

        $consumable = New Consumable;

         $consumable->title = $request->title;
         $consumable->price = $request->price;
         $consumable->category = $request->category;
         $consumable->restaurant_id = $request->restaurant_id;

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $destinationPath = public_path('/uploads/avatars/');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->fit(300, 300)->save($destinationPath . $filename);
            $consumable->avatar = $filename;
        }

        $consumable->save();

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $consumable = Consumable::findOrFail($id);
        $consumable->title = $request->title;
        $consumable->price = $request->price;
        $consumable->category = $request->category;

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $destinationPath = public_path('/uploads/avatars/');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            if ($consumable->avatar !== 'default.png') {
                $file = 'uploads/avatars/' . $consumable->avatar;
                if (File::exists($file)) {
                    unlink($file);
                }
            }
            Image::make($avatar)->fit(300, 300)->save($destinationPath . $filename);
            $consumable->avatar = $filename;
        }

        $consumable->save();

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consumable = Consumable::findOrFail($id);
        $image_path = 'uploads/avatars/'.$consumable->avatar;

        File::delete($image_path);

        $consumable->delete();

        return Redirect::back();
    }
}
