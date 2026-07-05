<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
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
}