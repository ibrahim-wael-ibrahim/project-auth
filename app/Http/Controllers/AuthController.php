<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function register( Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'role' => 'in:admin,employee',
        ]);

        // Set default role to 'admin' if not provided in the request
        $userData = array_merge($data, ['role' => $data['role'] ?? 'admin']);


        // Mass assign the validated request data to a new instance of the User model
        $user = User::create($userData);
        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' =>$token,
            'Type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        // return response()->json([
        //     'token' => $token,
        //     'Type' => 'Bearer',
        //     'role' => $user->role // include user role in response
        // ]);
        // Log the user in
        Auth::login($user);

        // Redirect based on the user role
        if ($user->role == 'admin') {
            // Redirect to admin route if user is admin
            return redirect()->route('admin');
        } else if ($user->role == 'employee') {
            // Redirect to employee route if user is an employee
            return redirect()->route('employee');
        }

        // Fallback if no valid role
        return redirect()->route('login')->with('error', 'Unauthorized access');
    }

    public function show(){
        return " All users are shown here";
    }
    public function update(Request $request , $id){
        return " All updates on users are done here";
        }
}
