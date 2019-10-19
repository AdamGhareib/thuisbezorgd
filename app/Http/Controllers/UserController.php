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

class UserController extends Controller
{
    public function profile() {
    	return view('profile.profile', array('user' => Auth::user()) );
    }

    public function editProfile() {
        return view('profile.editprofile', array('user' => Auth::user()) );
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $image_path = 'uploads/avatars/'.$user->avatar;

        File::delete($image_path);

        $user->delete();

        return redirect('/login');
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->zipcode = $request->zipcode;

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $destinationPath = public_path('/uploads/avatars/');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            if ($user->avatar !== 'default.png') {
                $file = 'uploads/avatars/' . $user->avatar;
                if (File::exists($file)) {
                    unlink($file);
                }
            }
            Image::make($avatar)->fit(300, 300)->save($destinationPath . $filename);
            $user->avatar = $filename;
        }

        $user->save();

        return redirect('/profile');
    }

    public function edit($id) {
        $user = User::find($id);

        return view('profile.editprofile')
        ->with('user', $user);
    }

    public function show($id) {
        $user = User::where('id', $id)
        ->FirstOrFail();

        return view('profile.profile')
        ->with('user', $user);
    }
}
