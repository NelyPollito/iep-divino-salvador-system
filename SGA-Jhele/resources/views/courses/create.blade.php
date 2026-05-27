<x-layouts.admin-layout title="Nuevo Curso">
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Cursos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-header card-header-text">
                        <h4 class="card-title">Nuevo Curso</h4>
                    </div>
                    <div class="card-content p-4">
                        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Semestre / Periodo <span class="text-danger">*</span></label>
                                        <select class="form-control" name="idsemester" id="select-semester" required>
                                            <option value="">Seleccione Semestre</option>
                                            @foreach($semesters as $semester)
                                                <option value="{{ $semester->idsemester }}">
                                                    {{ $semester->period->period_name }} - {{ $semester->semester_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Grado <span class="text-danger">*</span></label>
                                        <select class="form-control" name="iddegree" id="select-degree" required disabled>
                                            <option value="">Seleccione Grado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Subgrado <span class="text-danger">*</span></label>
                                        <select class="form-control" name="idsubgrade" id="select-subgrade" required disabled>
                                            <option value="">Seleccione Subgrado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre del Curso <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="course_name" required placeholder="Ej: Matemáticas">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Docente <span class="text-danger">*</span></label>
                                        <select class="form-control" name="idteacher" required>
                                            <option value="">Seleccione Docente</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->idteacher }}">{{ $teacher->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto del curso <span class="text-danger">*</span></label>
                                        <input type="file" name="photo" class="form-control-file" onchange="readURL(this);" required>
                                        <div class="mt-2">
                                            <img id="preview" src="{{ asset('backend/img/noimage.png') }}" width="100" style="border: 1px solid #ddd; padding: 5px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-success">Añadir Curso</button>
                            <a href="{{ route('courses.index') }}" class="btn btn-danger">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) { $('#preview').attr('src', e.target.result); };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            $('#select-semester').on('change', function() {
                var semesterId = $(this).val();
                $('#select-degree').empty().append('<option value="">Cargando...</option>').prop('disabled', true);
                $('#select-subgrade').empty().append('<option value="">Seleccione Subgrado</option>').prop('disabled', true);

                if (semesterId) {
                    $.get('/get-grades/' + semesterId, function(data) {
                        $('#select-degree').empty().append('<option value="">Seleccione Grado</option>').prop('disabled', false);
                        $.each(data, function(index, value) {
                            $('#select-degree').append('<option value="'+value.iddegree+'">'+value.degree_name+'</option>');
                        });
                    });
                }
            });

            $('#select-degree').on('change', function() {
                var degreeId = $(this).val();
                $('#select-subgrade').empty().append('<option value="">Cargando...</option>').prop('disabled', true);

                if (degreeId) {
                    $.get('/get-subgrades/' + degreeId, function(data) {
                        $('#select-subgrade').empty().append('<option value="">Seleccione Subgrado</option>').prop('disabled', false);
                        $.each(data, function(index, value) {
                            $('#select-subgrade').append('<option value="'+value.idsubgrade+'">'+value.subgrade_name+'</option>');
                        });
                    });
                }
            });
        });
    </script>
    @endpush
</x-layouts.admin-layout>