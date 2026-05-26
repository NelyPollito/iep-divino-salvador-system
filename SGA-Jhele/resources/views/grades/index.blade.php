<x-layouts.admin-layout title="Resumen de Calificaciones">
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Calificaciones</li>
                    </ol>
                </nav>

                <div class="card" style="min-height:485px">
                    <div class="card-header card-header-text d-flex justify-content-between">
                        <h4 class="card-title">Resumen de Calificaciones por Sección</h4>
                        <a href="{{ route('grades.create') }}" class="btn btn-danger text-white">
                            <i class='material-icons'>add</i>
                        </a>
                    </div>
                    
                    <div class="card-content table-responsive p-4">
                        @if($grades->count() > 0)
                            <table class="table table-hover" id="example">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Periodo/Semestre</th>
                                        <th>Sección</th>
                                        <th>Grado/Subgrado</th>
                                        <th>Curso</th>
                                        <th>N° Alumnos</th>
                                        <th>Prom. Prácticas</th>
                                        <th>Prom. Exámenes</th>
                                        <th>Promedio General</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grades as $g)
                                        <tr>
                                            <td><span class="badge badge-danger">{{ $g->period_name }}</span><br><small class="text-muted">{{ $g->semester_name ?? 'N/A' }}</small></td>
                                            <td><span class="badge badge-dq3">{{ $g->section_name }}</span></td>
                                            <td><span class="badge badge-dbe">{{ $g->degree_name }}</span><br><small class="text-muted">{{ $g->subgrade_name ?? 'N/A' }}</small></td>
                                            <td><span class="badge badge-success">{{ $g->course_name }}</span></td>
                                            <td>{{ $g->total_students }}</td>
                                            <td>{{ $g->avg_practica ?? '0.00' }}</td>
                                            <td>{{ $g->avg_examen ?? '0.00' }}</td>
                                            <td>
                                                <span class="badge {{ ($g->section_average < 11) ? 'badge-danger' : 'badge-dbe' }}">
                                                    {{ $g->section_average }}
                                                </span>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning">
                                <strong>No hay calificaciones registradas!</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
        // Si ya existe una instancia, la destruimos para evitar el warning
        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().destroy();
        }

        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            // Esto permite que si se intenta inicializar de nuevo, no explote
            retrieve: true, 
            paging: true
        });
    });
    </script>
    @endpush
   

</x-layouts.admin-layout>