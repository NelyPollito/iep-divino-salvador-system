<x-layouts.admin-layout title="Mostrar Secciones">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Sección</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mostrar</li>
                </ol>
            </nav>
            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Gestión de Secciones</h4>
                    <a href="{{ route('sections.create') }}" class="btn btn-danger text-white">
                        <i class='material-icons'>add</i>
                    </a>
                </div>

                <div class="card-content table-responsive">
                    <table class="table table-hover" id="example">
                        <thead class="text-primary">
                            <tr>
                                <th>Periodo</th>
                                <th>Sección</th>
                                <th>Grado</th>
                                <th>Subgrado</th>
                                <th>Curso</th>
                                <th>Docente</th>
                                <th>Capacidad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                            <tr>
                                {{-- Acceso anidado: Section -> Course -> Semester -> Period --}}
                                <td>
                                    <span class="badge badge-dbe">
                                        {{ $section->course->semester->period->period_name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td><span class="badge badge-dq3">{{ $section->section_name }}</span></td>
                                <td>
                                    <span class="badge badge-cekj">
                                        {{ $section->course->degree->degree_name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $section->course->subgrade->subgrade_name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td><span class="badge badge-dfae">{{ $section->course->course_name }}</span></td>
                                <td>
                                    @foreach($section->course->teachers as $teacher)
                                        <span class="badge badge-danger">{{ $teacher->full_name }}</span>
                                    @endforeach
                                </td>
                                <td><span class="badge badge-darkr">{{ $section->capacity }}</span></td>
                                <td>
                                    @if($section->status == 1)
                                        <span class="badge badge-success">Activo</span>
                                    @else
                                        <span class="badge badge-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sections.edit', $section->idsection) }}" class="btn btn-warning text-white">
                                        <i class='material-icons' title='edit'>warning</i>
                                    </a>
                                    
                                    @if($section->status == 1)
                                        <a href="{{ route('sections.showDelete', $section->idsection) }}" class="btn btn-danger text-white">
                                            <i class='material-icons' title='delete'>delete_forever</i>
                                        </a>
                                        {{-- El botón "entrar" o "logout" --}}
                                        <a href="{{ route('sections.manage', $section->idsection) }}" class="btn btn-dark text-white">
                                            <i class='material-icons' title='logout'>logout</i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts de Datatables --}}
{{-- Scripts de Datatables --}}
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