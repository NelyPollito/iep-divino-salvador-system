<x-layouts.admin-layout title="Nueva Sección">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sections.index') }}">Sección</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                </ol>
            </nav>

            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Nueva sección</h4>
                </div>
                <div class="card-content">
                    <div class="alert alert-warning">
                        <strong>Estimado usuario!</strong> Los campos remarcados con <span class="text-danger">*</span> son necesarios.
                    </div>

                    <form action="{{ route('sections.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Periodo<span class="text-danger">*</span></label>
                                    <select class="form-control" id="prd" required>
                                        <option value="">Seleccione Periodo</option>
                                        @foreach($periods as $p)
                                            <option value="{{ $p->idperiod }}">{{ $p->period_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Grado<span class="text-danger">*</span></label>
                                    <select class="form-control" id="grd" required>
                                        <option value="">Seleccione Grado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label>Subgrado<span class="text-danger">*</span></label>
                                    <select class="form-control" id="sub" required name="txtsgrd">
                                        <option value="">Seleccione Subgrado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Nombre de la sección<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txtnamsecc" required placeholder="ejm: A, B o 101">
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Capacidad<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="txtcapc" required placeholder="ejm: 30">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 col-lg-12">
                                <label>Cursos disponibles (marque para asignar)<span class="text-danger">*</span></label>
                                <div id="curso" class="row p-3 border rounded bg-light mx-1">
                                    <p class="text-muted">Seleccione un subgrado para ver los cursos disponibles.</p>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success text-white">Añadir Sección</button>
                            <a class="btn btn-danger text-white" href="{{ route('sections.index') }}">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // 1. Cuando cambie el Periodo -> Cargar Grados
    $('#prd').on('change', function() {
        let id = $(this).val();
        $('#grd').empty().append('<option value="">Cargando...</option>');
        $('#sub').empty().append('<option value="">Seleccione Subgrado</option>');
        $('#curso').empty().append('<p class="text-muted">Seleccione un subgrado para ver los cursos.</p>');

        if(id) {
            $.get(`/get-grades/${id}`, function(data) {
                $('#grd').empty().append('<option value="">Seleccione Grado</option>');
                data.forEach(grado => {
                    $('#grd').append(`<option value="${grado.iddegree}">${grado.degree_name}</option>`);
                });
            });
        }
    });

    // 2. Cuando cambie el Grado -> Cargar Subgrados
    $('#grd').on('change', function() {
        let id = $(this).val();
        $('#sub').empty().append('<option value="">Cargando...</option>');
        $('#curso').empty().append('<p class="text-muted">Seleccione un subgrado para ver los cursos.</p>');

        if(id) {
            $.get(`/get-subgrades/${id}`, function(data) {
                $('#sub').empty().append('<option value="">Seleccione Subgrado</option>');
                data.forEach(sub => {
                    $('#sub').append(`<option value="${sub.idsubgrade}">${sub.subgrade_name}</option>`);
                });
            });
        }
    });

    // 3. Cuando cambie el Subgrado -> Cargar Cursos (Checkboxes)
    $('#sub').on('change', function() {
        let id = $(this).val();
        $('#curso').empty().append('<p class="text-muted col-12">Cargando cursos...</p>');

        if(id) {
            $.get(`/get-courses/${id}`, function(data) {
                $('#curso').empty();
                if(data.length > 0) {
                    data.forEach(curso => {
                        $('#curso').append(`
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="idcur[]" value="${curso.idcourse}" class="form-check-input" id="cur_${curso.idcourse}">
                                    <label class="form-check-label" for="cur_${curso.idcourse}">
                                        ${curso.course_name}
                                    </label>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    $('#curso').append('<p class="text-danger col-12">No hay cursos activos para este subgrado.</p>');
                }
            });
        }
    });
});
</script>
@endpush

</x-layouts.admin-layout>