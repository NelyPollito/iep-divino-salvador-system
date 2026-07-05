<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constancia de Notas</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 19px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
        }

        .title {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 25px;
        }

        .content {
            text-align: justify;
            line-height: 1.6;
        }

        .student-data,
        .grades-table {
            width: 100%;
            border-collapse: collapse;
            margin: 18px 0;
        }

        .student-data th,
        .student-data td,
        .grades-table th,
        .grades-table td {
            border: 1px solid #333;
            padding: 7px;
            text-align: left;
        }

        .student-data th {
            width: 35%;
            background-color: #f2f2f2;
        }

        .grades-table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .date {
            margin-top: 25px;
        }

        .signature {
            text-align: center;
            margin-top: 70px;
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
        CONSTANCIA DE NOTAS
    </div>

    <div class="content">
        <p>
            El que suscribe, en representación de la Institución Educativa Particular
            Divino Salvador, deja constancia de las calificaciones registradas del/de la estudiante:
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
        </table>

        <p>
            Las notas académicas registradas en el sistema son las siguientes:
        </p>

        @if($grades->count() > 0)
            <table class="grades-table">
                <thead>
                    <tr>
                        <th>Periodo</th>
                        <th>Semestre</th>
                        <th>Grado</th>
                        <th>Subgrado</th>
                        <th>Sección</th>
                        <th>Curso</th>
                        <th>Evaluación</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grades as $grade)
                        <tr>
                            <td>{{ $grade->period_name }}</td>
                            <td>{{ $grade->semester_name }}</td>
                            <td>{{ $grade->degree_name }}</td>
                            <td>{{ $grade->subgrade_name }}</td>
                            <td class="center">{{ $grade->section_name }}</td>
                            <td>{{ $grade->course_name }}</td>
                            <td>{{ $grade->evaluation_name }}</td>
                            <td class="center">{{ $grade->grade }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>
                El/la estudiante no registra notas académicas en el sistema.
            </p>
        @endif

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