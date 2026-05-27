<x-layouts.admin-layout title="Listado de Cursos">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Cursos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mostrar</li>
                </ol>
            </nav>

            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Cursos Académicos</h4>
                    <a href="{{ route('courses.create') }}" class="btn btn-danger text-white">
                        <i class='material-icons' title='Add'>add</i>
                    </a>
                </div>

                <div class="card-content table-responsive">
                    @if($courses->count() > 0)
                    <table class="table table-hover" id="example">
                        <thead class="text-primary">
                            <tr>
                                <th>Foto</th>
                                <th>Periodo Escolar</th>
                                <th>Grado</th>
                                <th>Subgrado</th>
                                <th>Curso</th>
                                <th>Docente</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td>
                                    @if($course->photo)
                                        <img src="{{ asset('backend/img/subidas/' . $course->photo) }}" width="90" class="rounded">
                                    @else
                                        <img src="{{ asset('backend/img/no-image.png') }}" width="70" class="rounded">
                                    @endif
                                </td>
                                <td><span class="badge badge-dq3">{{ $course->semester->period->period_name ?? 'N/A' }}</span></td>
                                <td><span class="badge badge-dbe">{{ $course->degree->degree_name }}</span></td>
                                <td><span class="badge badge-danger">{{ $course->subgrade->subgrade_name }}</span></td>
                                <td><span class="badge badge-success">{{ $course->course_name }}</span></td>
                                <td>
                                    @if($course->teachers->count() > 0)
                                        @foreach($course->teachers as $teacher)
                                            <span class="badge badge-cekj">
                                                {{ $teacher->full_name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="badge badge-secondary">
                                            Sin asignar
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $course->status == 1 ? 'badge-success' : 'badge-danger' }}">
                                        {{ $course->status == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('courses.edit', $course->idcourse) }}" class="btn btn-warning btn-sm text-white">
                                        <i class='material-icons'>warning</i>
                                    </a>
                                    
                                    @if($course->status == 1)
                                    <a href="{{ route('courses.showDelete', $course->idcourse) }}" class="btn btn-danger btn-sm text-white">
                                        <i class='material-icons'>delete_forever</i>
                                    </a>
                                    @endif

                                    <a href="{{ route('courses.editPhoto', $course->idcourse) }}" class="btn btn-info btn-sm text-white">
                                        <i class='material-icons'>image</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning"><strong>No hay cursos registrados!</strong></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().destroy();
        }

        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            retrieve: true, 
            paging: true
        });
    });

    </script>
@endpush

</x-layouts.admin-layout>