<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
            $users = User::with(['role', 'student', 'teacher', 'father'])
                        ->orderBy('iduser', 'DESC')
                        ->get();

            return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Para el select de roles
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'username' => 'required|unique:users,username,'.$id.',iduser',
            'email' => 'required|email|unique:users,email,'.$id.',iduser',
            'idrole' => 'required',
            'status' => 'required'
        ]);
        
        if ($request->has('unlock_user')) {
            $user->login_attempts = 0;
            $user->locked_until = null;
        }

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'idrole' => $request->idrole,
            'status' => $request->status,
            'login_attempts' => $user->login_attempts,
            'locked_until' => $user->locked_until,
        ]);

        return redirect()->route('users.index')->with('actualizado', 'OK');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        $user->update(['status' => 0]);

        return redirect()->route('users.index')->with('desactivado', 'OK');
    }

    public function confirm($id) {
        $user = User::findOrFail($id);
        return view('users.delete', compact('user'));
    }



    public function editPhoto($id)
    {
        $user = User::findOrFail($id);
        return view('users.photo', compact('user'));
    }

    public function updatePhoto(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            $destinationPath = public_path('backend/img/subidas');

           

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);

            $user->update(['photo' => $filename]);
        }

        return redirect()->route('users.index')->with('foto_actualizada', 'OK');
    }



    public function create()
    {
        $roles = Role::all(); 
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'idrole'   => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password), 
            'idrole'   => $request->idrole,
            'status'   => 1, 
        ]);

        return redirect()->route('users.index')->with('creado', 'OK');
    }
}