<x-layouts.admin-layout title="Constancia de Estudios">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('students.index') }}">Alumnos</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Constancia de Estudios
                    </li>
                </ol>
            </nav>

            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Constancia de Estudios</h4>
                </div>

                <div class="card-content">

                    <div id="constancia-estudios" style="padding: 35px; max-width: 850px; margin: auto; border: 1px solid #ddd;">

                        <div class="text-center" style="text-align:center; margin-bottom: 30px;">
                            <h3>Institución Educativa Particular Divino Salvador</h3>
                            <p>Chachapoyas - Perú</p>
                        </div>

                        <h3 style="text-align:center; text-decoration: underline; margin-bottom: 35px;">
                            CONSTANCIA DE ESTUDIOS
                        </h3>

                        <p style="text-align: justify; line-height: 1.8;">
                            El que suscribe, en representación de la Institución Educativa Particular
                            Divino Salvador, deja constancia que el/la estudiante:
                        </p>

                        <table class="table table-bordered">
                            <tr>
                                <th>Apellidos y nombres</th>
                                <td>{{ $student->full_name }}</td>
                            </tr>
                            <tr>
                                <th>DNI</th>
                                <td>{{ $student->dni }}</td>
                            </tr>
                            <tr>
                                <th>Fecha de nacimiento</th>
                                <td>{{ $student->birth_date }}</td>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <td>{{ $student->address ?? 'No registrada' }}</td>
                            </tr>

                            @if($enrollment)
                                <tr>
                                    <th>Sección</th>
                                    <td>{{ $enrollment->section->section_name ?? 'No registrada' }}</td>
                                </tr>
                                <tr>
                                    <th>Curso</th>
                                    <td>{{ $enrollment->section->course->course_name ?? 'No registrado' }}</td>
                                </tr>
                                <tr>
                                    <th>Grado</th>
                                    <td>{{ $enrollment->section->course->degree->degree_name ?? 'No registrado' }}</td>
                                </tr>
                                <tr>
                                    <th>Subgrado</th>
                                    <td>{{ $enrollment->section->course->subgrade->subgrade_name ?? 'No registrado' }}</td>
                                </tr>
                                <tr>
                                    <th>Semestre</th>
                                    <td>{{ $enrollment->section->course->semester->semester_name ?? 'No registrado' }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de matrícula</th>
                                    <td>{{ $enrollment->enrollment_date }}</td>
                                </tr>
                            @else
                                <tr>
                                    <th>Situación académica</th>
                                    <td>No registra matrícula activa.</td>
                                </tr>
                            @endif
                        </table>

                        <p style="text-align: justify; line-height: 1.8;">
                            Se encuentra registrado(a) en nuestra institución educativa, conforme a la
                            información académica almacenada en el sistema.
                        </p>

                        <p style="text-align: justify; line-height: 1.8;">
                            Se expide la presente constancia a solicitud del interesado para los fines
                            que estime conveniente.
                        </p>

                        <p style="margin-top: 30px;">
                            Chachapoyas, {{ date('d/m/Y') }}.
                        </p>

                        <div style="text-align:center; margin-top: 80px;">
                            <p>______________________________</p>
                            <p><strong>Dirección Académica</strong></p>
                            <p>Institución Educativa Particular Divino Salvador</p>
                        </div>

                    </div>

                    <div class="text-center" style="text-align:center; margin-top: 25px;">
                        <button onclick="window.print()" class="btn btn-primary text-white">
                            Imprimir / Guardar como PDF
                        </button>

                        <a href="{{ route('students.index') }}" class="btn btn-danger text-white">
                            Volver
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</x-layouts.admin-layout>