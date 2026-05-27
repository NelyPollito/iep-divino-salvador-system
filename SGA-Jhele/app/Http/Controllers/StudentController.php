<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{

    public function dashboard()
    {
        return view('students.dashboard');
    }
    public function index()
    {
        // Obtenemos los alumnos cargando su relación 'user'
        $students = Student::with('user')->orderBy('idstudent', 'DESC')->get();
        return view('students.index', compact('students'));
    }

    public function create($iduser)
    {
        $user = User::findOrFail($iduser);
        return view('students.complete', compact('user'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'iduser'     => 'required|exists:users,iduser',
            'dni'        => 'required|unique:students,dni|digits:8',
            'full_name'  => 'required|string|max:100',
            'gender'     => 'required|in:M,F',
            'birth_date' => 'required|date',
            'address'    => 'nullable|string|max:255',
        ]);

        Student::create($request->all());

        return redirect()->route('users.index')->with('perfil_completado', 'OK');
    }

    // Actualizar 

    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        $request->validate([
            'dni'        => 'required|unique:students,dni,' . $id . ',idstudent|digits:8',
            'full_name'  => 'required|string|max:100',
            'gender'     => 'required',
            'birth_date' => 'required|date',
            'address'    => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $student->iduser . ',iduser',
            'status'     => 'required|in:0,1'
        ]);

        $student->update([
            'dni'        => $request->dni,
            'full_name'  => $request->full_name,
            'gender'     => $request->gender,
            'birth_date' => $request->birth_date,
            'address'    => $request->address,
        ]);

        $student->user->update([
            'email'  => $request->email,
            'status' => $request->status
        ]);

        return redirect()->route('students.index')->with('update_success', 'OK');
    }

    public function show($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('students.info', compact('student'));
    }

    public function delete($id)
{
    $student = Student::findOrFail($id);
    return view('students.delete', compact('student'));
}

    public function destroy(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        if ($student->user) {
            $student->user->update([
                'status' => '0' 
            ]);
        }

        return redirect()->route('students.index')->with('delete_success', 'OK');
    }


    public function editPhoto($id)
    {
        $student = Student::findOrFail($id);
        
        $user = $student->user; 

        return view('students.photo', compact('user', 'student'));
    }

public function updatePhoto(Request $request, $id)
{
    $student = Student::findOrFail($id);
    $user = $student->user;

    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $oldPath = public_path('backend/img/subidas/' . $user->photo);
        if ($user->photo && File::exists($oldPath)) {
            File::delete($oldPath);
        }

        // Procesar nueva foto
        $image = $request->file('foto');
        $name = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('backend/img/subidas'), $name);

        // Guardar en la tabla USERS
        $user->photo = $name;
        $user->save();
    }

    return redirect()->route('students.index')->with('photo_success', 'OK');
}
}