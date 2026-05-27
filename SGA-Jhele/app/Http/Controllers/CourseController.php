<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Degree;
use App\Models\Period;
use App\Models\Semester;
use App\Models\Subgrade;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['degree', 'subgrade', 'teachers', 'semester.period'])
                    ->orderBy('idcourse', 'DESC')
                    ->get();

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $semesters = Semester::with('period')->where('status', 1)->get();
        $degrees = Degree::where('status', 1)->get();
        $subgrades = Subgrade::where('status', 1)->get();
        $teachers = Teacher::all();
        
        return view('courses.create', compact('semesters', 'degrees', 'subgrades', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:100',
            'idsemester'  => 'required',
            'iddegree'    => 'required',
            'idsubgrade'  => 'required',
            'idteacher'   => 'required', // ID del docente seleccionado
            'photo'       => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $course = new Course();
        $course->course_name = $request->course_name;
        $course->idsemester = $request->idsemester;
        $course->iddegree = $request->iddegree;
        $course->idsubgrade = $request->idsubgrade;
        $course->status = 1;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('backend/img/subidas/'), $filename);
            $course->photo = $filename;
        }

        $course->save();

        $course->teachers()->attach($request->idteacher);

        return redirect()->route('courses.index')->with('add_successCourse', 'OK');
    }

    public function edit($id)
    {
        $course = Course::with([
            'teachers',
            'semester.period',
            'degree',
            'subgrade'
        ])->findOrFail($id);

        $periods = Semester::with('period')->get();
        $teachers = Teacher::all();
        $degrees = Degree::all();
        $subgrades = Subgrade::all();

        return view('courses.edit', compact(
            'course',
            'periods',
            'teachers',
            'degrees',
            'subgrades'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_name' => 'required|string|max:100',
            'idsemester'  => 'required',
            'iddegree'    => 'required',
            'idsubgrade'  => 'required',
            'idteacher'   => 'required',
            'status'      => 'required'
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'course_name' => $request->course_name,
            'idsemester'  => $request->idsemester,
            'iddegree'    => $request->iddegree,
            'idsubgrade'  => $request->idsubgrade,
            'status'      => $request->status,
        ]);

        $course->teachers()->sync([$request->idteacher]);

        return redirect()->route('courses.index')->with('update_successCourse', 'OK');
    }

    public function showDelete($id)
    {
        // Buscamos el curso con sus relaciones para informar al usuario qué está desactivando
        $course = Course::with(['degree', 'subgrade', 'semester.period'])->findOrFail($id);
        return view('courses.delete', compact('course'));
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        
        // Desactivación lógica
        $course->update(['status' => 0]);

        return redirect()->route('courses.index')->with('delete_successCourse', 'OK');
    }

    public function editPhoto($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.photo', compact('course'));
    }

    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $course = Course::findOrFail($id);

        if ($request->hasFile('photo')) {
            // 1. Borrar la foto anterior si existe
            $oldPath = public_path('backend/img/subidas/' . $course->photo);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            // 2. Subir la nueva foto
            $file = $request->file('photo');
            $filename = time() . '_course_' . $file->getClientOriginalName();
            $file->move(public_path('backend/img/subidas/'), $filename);

            // 3. Actualizar base de datos
            $course->update(['photo' => $filename]);
        }

        return redirect()->route('courses.index')->with('update_successCourse', 'OK');
    }


}