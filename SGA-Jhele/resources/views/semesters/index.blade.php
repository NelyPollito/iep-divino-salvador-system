<x-layouts.admin-layout title="Semestres">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Panel Control</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Semestres</li>
                </ol>
            </nav>
            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Listado de Semestres</h4>
                    <a href="{{ route('semesters.create') }}" class="btn btn-danger text-white">
                        <i class='material-icons' data-toggle='tooltip' title='Add'>add</i>
                    </a>
                </div>
                <div class="card-content table-responsive">
                    @if($semesters->count() > 0)
                        <table class="table table-hover" id="example">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Semestre</th>
                                    <th>Periodo Relacionado</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($semesters as $semester)
                                    <tr>
                                        <td>{{ $semester->idsemester }}</td>
                                        <td>{{ $semester->semester_name }}</td>
                                        <td>
                                            {{ $semester->period ? $semester->period->period_name : 'Sin Periodo' }}
                                        </td>
                                        <td>
                                            @if($semester->status == 1)
                                                <span class="badge badge-success">Activo</span>
                                            @else
                                                <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('semesters.edit', $semester->idsemester) }}" class="btn btn-warning text-white">
                                                <i class='material-icons' title='edit'>warning</i>
                                            </a>
                                            <a href="{{ route('semesters.showDelete', $semester->idsemester) }}" class="btn btn-danger text-white">
                                                <i class='material-icons' title='delete'>delete_forever</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning" style="margin-top: 20px;">
                            <strong>No hay datos!</strong> No se encontraron semestres registrados.
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