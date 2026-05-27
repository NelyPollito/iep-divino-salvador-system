<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{

    public function dashboard()
    {
        return view('teachers.dashboard');
    }

    public function create($iduser)
    {
        $user = User::findOrFail($iduser);
        return view('teachers.complete', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser'      => 'required|exists:users,iduser',
            'dni'         => 'required|unique:teachers,dni|digits:8',
            'full_name'   => 'required|string|max:100',
            'specialty'   => 'required|string|max:100', 
            'phone'       => 'nullable|string|max:15',
            'birth_date'  => 'required|date',
        ]);

        Teacher::create($request->all());

        return redirect()->route('users.index')->with('perfil_docente', 'OK');
    }

    public function index()
    {
        $teachers = Teacher::with('user')->orderBy('idteacher', 'DESC')->get();
        
        return view('teachers.index', compact('teachers'));
    }

    public function edit($id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;

        $request->validate([
            'dni' => 'required|numeric|digits:8',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->iduser . ',iduser',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'status' => 'required'
        ]);

        $teacher->update([
            'dni' => $request->dni,
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
        ]);

        $user->update([
            'email' => $request->email,
            'status' => $request->status,
        ]);

        return redirect()->route('teachers.index')->with('update_success', 'OK');
    }

    //Delete 
    public function delete($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.delete', compact('teacher'));
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;

        if ($user) {
            $user->status = '0';
            $user->save();
        }

        return redirect()->route('teachers.index')->with('deletee_success', 'OK');
    }


    // Photo

    public function editPhoto($id)
    {

        $teacher = Teacher::with('user')->findOrFail($id);
        return view('teachers.photo', compact('teacher'));
    }

    public function updatePhoto(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;

        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $destinationPath = public_path('backend/img/subidas');
            $oldFilePath = $destinationPath . '/' . $user->photo;

            if ($user->photo && File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            $image = $request->file('foto');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move($destinationPath, $filename);

            $user->photo = $filename;
            $user->save();
        }

        return redirect()->route('teachers.index')->with('update_success', 'Foto actualizada correctamente');
    }

    // SHOW
    public function show($id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('teachers.info', compact('teacher'));
    }
}