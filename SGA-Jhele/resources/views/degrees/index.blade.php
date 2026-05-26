<x-layouts.admin-layout title="Grado Académico">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('degrees.index') }}">Grado Académico</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mostrar</li>
                </ol>
            </nav>
            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Grado Académico</h4>
                    <a href="{{ route('degrees.create') }}" class="btn btn-danger text-white">
                        <i class='material-icons' data-toggle='tooltip' title='Add'>add</i>
                    </a>
                </div>

                <div class="card-content table-responsive">
                    @if($degrees->count() > 0)
                        <table class="table table-hover" id="example">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Periodo / Semestre</th>
                                    <th>Nombre del Grado</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($degrees as $degree)
                                    <tr>
                                        <td>{{ $degree->iddegree }}</td>
                                        <td>
                                            <span class="badge badge-danger">
                                                {{ $degree->semester->period->period_name ?? 'N/A' }}
                                            </span>
                                            <br>
                                            <small class="text-muted">{{ $degree->semester->semester_name ?? 'N/A' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-dbe">{{ $degree->degree_name }}</span>
                                        </td>
                                        <td>
                                            @if($degree->status == 1)
                                                <span class="badge badge-success">Activo</span>
                                            @else
                                                <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('degrees.edit', $degree->iddegree) }}" class="btn btn-warning text-white">
                                                <i class='material-icons' title='edit'>warning</i>
                                            </a>
                                            @if($degree->status == 1)
                                            <a href="{{ route('degrees.showDelete', $degree->iddegree) }}" class="btn btn-danger text-white">
                                                <i class='material-icons' title='delete'>delete_forever</i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning" style="margin-top: 20px;">
                            <strong>No hay datos!</strong>
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