<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updatePassword(Request $request)
    {
        $rules = [
            'password' => 'required|min:5|max:255'
        ];

        $validatedData = $request->validate($rules);

        if ($request['password'] == $request['password2']) {
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::where('email', $request['email'])->update($validatedData);

            return redirect('/dashboard/settings')->with('success', 'Password has been updated!');
        }
    }
}
