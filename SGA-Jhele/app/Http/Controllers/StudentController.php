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



    // Mostrar formulario vinculando al iduser
    public function create($iduser)
    {
        $user = User::findOrFail($iduser);
        return view('students.complete', compact('user'));
    }

    // Guardar los datos en la tabla 'students'
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
        // Buscamos el estudiante con su usuario vinculado
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

        // 1. Actualizar datos en la tabla 'students'
        $student->update([
            'dni'        => $request->dni,
            'full_name'  => $request->full_name,
            'gender'     => $request->gender,
            'birth_date' => $request->birth_date,
            'address'    => $request->address,
        ]);

        // 2. Actualizar datos en la tabla 'users' vinculada
        $student->user->update([
            'email'  => $request->email,
            'status' => $request->status
        ]);

        return redirect()->route('students.index')->with('update_success', 'OK');
    }

    public function show($id)
    {
        // Buscamos el estudiante y cargamos su usuario para la foto, email y username
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

        // Desactivamos el usuario vinculado
        if ($student->user) {
            $student->user->update([
                'status' => '0' // Cambiamos a Inactivo
            ]);
        }

        return redirect()->route('students.index')->with('delete_success', 'OK');
    }


    public function editPhoto($id)
    {
        // Buscamos al estudiante por su ID de alumno
        $student = Student::findOrFail($id);
        
        // Obtenemos el usuario vinculado a ese alumno
        $user = $student->user; 

        return view('students.photo', compact('user', 'student'));
    }

public function updatePhoto(Request $request, $id)
{
    // El $id es idstudent, buscamos al alumno
    $student = Student::findOrFail($id);
    $user = $student->user;

    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        // Borrar foto antigua si existe
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