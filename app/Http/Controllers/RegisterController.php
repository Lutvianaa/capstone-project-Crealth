<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request) {
        if (User::where('email', $request->email)->first() == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender' => $request->gender, 
                'birth_date' => $request->birth_date, 
            ]);

            return response()->json(['message' => 'Successfully registered', 'error' => false], 201);
        } else {
            return response()->json(['message' => 'Failed to register. Email has already been used', 'error' => true], 400);
        }
    }
}
