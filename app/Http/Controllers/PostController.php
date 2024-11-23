<?php

// app/Http/Controllers/PostController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show()
    {
        // Fetch users with 'employee' role only
        $employees = User::where('role', 'employee')->get();

        return response()->json($employees);
    }

    public function update(Request $request)
    {
        // Update employee details (if role is 'employee')
        $user = User::find($request->id);
        if ($user && $user->role == 'employee') {
            $user->update($request->only('name', 'email'));
            return response()->json(['message' => 'Employee updated successfully!']);
        }

        return response()->json(['message' => 'Unauthorized or user not found'], 403);
    }
}

