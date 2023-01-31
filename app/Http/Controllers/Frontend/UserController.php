<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.users.profile');
    }

    public function updateUserDetails(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'phone' => ['required', 'max:13'],
            'pincode' => ['required', 'max:6'],
            'address' => ['required', 'string', 'max:499'],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->username
        ]);

        $user->userDetail()->updateOrCreate(
            [
            'user_id' => $user->id,
            ],
            [
            'phone' => $request->phone,
            'pincode' => $request->pincode,
            'address' => $request->address,
            ]
        );

        return redirect()->back()->with('message', 'User Profile Updated');
    }

    public function changePassword()
    {
        return view('frontend.users.change-password');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'min:8', 'string', 'confirmed'],
        ]);

        $currentPassword = Hash::check($request->current_password, Auth::user()->password);

        if ($currentPassword)
        {
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->back()->with('message', 'Password Changed Successfully.');
        }
        else
        {
            return redirect()->back()->with('danger', 'Current Password Does Not Match With Old Password.');
        }
    }
}
