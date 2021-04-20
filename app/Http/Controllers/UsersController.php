<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'Users' => User::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // return response()->json([
        //     'message' => 'User successfully registered!',
        //     'token' => $user->createToken('API Token')->plainTextToken
        // ], 200);
        return redirect()->route('users')->with(['success' => 'User has been registed!!!']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return Inertia::render('Users/Edit', [
            'editUser' => $user
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:users,name,' . $request->id],
            'role' => 'required'
        ])->validate();

        $user = User::find($request->id);
        $user->update($request->only(['name', 'role']));
        $user->save();

        return redirect()->route('users')->with(['success' => 'User has been updated!!!']);
    }

    public function destroy(User $user)
    {
        $user->votes()->delete();
        $user->nomination()->delete();
        $user->delete();

        return redirect()->route('users')->with(['success' => 'User data has been deleted']);
    }
}
