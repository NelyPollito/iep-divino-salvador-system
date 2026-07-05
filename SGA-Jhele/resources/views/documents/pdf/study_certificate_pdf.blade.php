<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constancia de Estudios</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #000;
            margin: 35px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
        }

        .content {
            text-align: justify;
            line-height: 1.7;
        }

        .student-data {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .student-data th,
        .student-data td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        .student-data th {
            width: 35%;
            background-color: #f2f2f2;
        }

        .date {
            margin-top: 30px;
        }

        .signature {
            text-align: center;
            margin-top: 80px;
        }

        .signature p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Institución Educativa Particular Divino Salvador</h2>
        <p>Chachapoyas - Perú</p>
    </div>

    <div class="title">
        CONSTANCIA DE ESTUDIOS
    </div>

    <div class="content">
        <p>
            El que suscribe, en representación de la Institución Educativa Particular
            Divino Salvador, deja constancia que el/la estudiante:
        </p>

        <table class="student-data">
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

        <p>
            Se encuentra registrado(a) en nuestra institución educativa, conforme a la
            información académica almacenada en el sistema.
        </p>

        <p>
            Se expide la presente constancia a solicitud del interesado para los fines
            que estime conveniente.
        </p>

        <p class="date">
            Chachapoyas, {{ date('d/m/Y') }}.
        </p>
    </div>

    <div class="signature">
        <p>______________________________</p>
        <p><strong>Dirección Académica</strong></p>
        <p>Institución Educativa Particular Divino Salvador</p>
    </div>

</body>
</html>