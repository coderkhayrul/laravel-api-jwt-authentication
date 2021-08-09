<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // USER REGISTER  API - POST
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'phone_no' => 'required',
            'password' => 'required | confirmed',
        ]);

        // Create User data + save
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->password = bcrypt($request->password);

        $user->save();

        // send Response
        return response()->json([
            'status' => '1',
            'message' => 'User Registation Successfully',
        ], 200);
    }
    // USER LOGIN API - POST
    public function login(Request $request)
    {
    }
    // USER PROFILE API - GET
    public function profile($id)
    {
    }
    // USER LOGOUT API - GET
    public function logout()
    {
    }
}
