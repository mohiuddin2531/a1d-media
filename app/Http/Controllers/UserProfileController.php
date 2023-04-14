<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;


use App\Models\User;
use App\Models\Status;

class UserProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();
        $statuses = Status::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('profile', ['statuses' => $statuses]);
    }



    public function edit()
    {
        $user = auth()->user();
        return view('userProfile_edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'password_confirmation.confirmed' => 'The password confirmation does not match.',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($validatedData['password']) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile_pictures'), $filename); 
            $user->profile_picture = $filename;
        }

        $user->save();

        return redirect()->route('showProfile')->with('success', 'Profile updated successfully!');
    }


    
    




}
