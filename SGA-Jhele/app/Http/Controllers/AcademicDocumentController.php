<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AcademicDocumentController extends Controller
{
    public function studyCertificate($id)
    {
        $student = Student::with('user')->findOrFail($id);

        $enrollment = Enrollment::with([
            'section.course.degree',
            'section.course.subgrade',
            'section.course.semester'
        ])
        ->where('idstudent', $id)
        ->where('status', 1)
        ->latest('enrollment_date')
        ->first();

        $pdf = Pdf::loadView('documents.pdf.study_certificate_pdf', compact('student', 'enrollment'));

        return $pdf->stream('constancia-estudios-' . $student->dni . '.pdf');
    }

    public function gradeCertificate($id)
    {
        $student = Student::with('user')->findOrFail($id);

        $grades = DB::table('grades as g')
            ->join('courses as c', 'g.idcourse', '=', 'c.idcourse')
            ->join('evaluation_types as et', 'g.idevaluation_type', '=', 'et.idevaluation_type')
            ->join('sections as sec', 'g.idsection', '=', 'sec.idsection')
            ->join('subgrades as sg', 'c.idsubgrade', '=', 'sg.idsubgrade')
            ->join('degrees as d', 'sg.iddegree', '=', 'd.iddegree')
            ->join('semesters as sem', 'c.idsemester', '=', 'sem.idsemester')
            ->join('periods as p', 'sem.idperiod', '=', 'p.idperiod')
            ->select(
                'p.period_name',
                'sem.semester_name',
                'd.degree_name',
                'sg.subgrade_name',
                'sec.section_name',
                'c.course_name',
                'et.evaluation_name',
                'g.grade',
                'g.created_at'
            )
            ->where('g.idstudent', $id)
            ->orderBy('p.period_name', 'DESC')
            ->orderBy('sem.semester_name', 'ASC')
            ->orderBy('c.course_name', 'ASC')
            ->orderBy('et.idevaluation_type', 'ASC')
            ->get();

        $pdf = Pdf::loadView('documents.pdf.grade_certificate_pdf', compact('student', 'grades'));

        return $pdf->stream('constancia-notas-' . $student->dni . '.pdf');
    }
}