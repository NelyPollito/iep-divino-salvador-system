<x-layouts.admin-layout title="Periodo Escolar">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Panel Control</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('periods.index') }}">Periodo escolar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mostrar</li>
                </ol>
            </nav>

            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Periodo escolar</h4>
                    <a href="{{ route('periods.create') }}" class="btn btn-danger text-white">
                        <i class='material-icons' data-toggle='tooltip' title='Add'>add</i>
                    </a>
                </div>

                <div class="card-content table-responsive">
                    @if($periods->count() > 0)
                        <table class="table table-hover" id="example">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Periodo escolar</th>
                                    <th>Fechas (Inicio - Fin)</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($periods as $period)
                                    <tr>
                                        <td>{{ $period->idperiod }}</td>
                                        <td>{{ $period->period_name }}</td>
                                        <td>
                                            <small>{{ $period->start_date }} al {{ $period->end_date }}</small>
                                        </td>
                                        <td>
                                            @if($period->status == 1)
                                                <span class="badge badge-success">Activo</span>
                                            @else
                                                <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('periods.edit', $period->idperiod) }}" class="btn btn-warning text-white">
                                                <i class='material-icons' data-toggle='tooltip' title='edit'>warning</i>
                                            </a>

                                            <a href="{{ route('periods.showDelete', $period->idperiod) }}" class="btn btn-danger text-white">
                                                <i class='material-icons' data-toggle='tooltip' title='Desactivar'>delete_forever</i>
                                            </a>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning" style="position: relative; margin-top: 14px; margin-bottom: 0px;">
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