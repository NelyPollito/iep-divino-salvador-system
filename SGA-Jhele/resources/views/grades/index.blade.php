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
                                                <button 
                                                    type="button"
                                                    class="btn btn-warning btn-sm text-white btn-edit-grades"

                                                    data-section="{{ $g->idsection }}"
                                                    data-course="{{ $g->idcourse }}"

                                                    data-section-name="{{ $g->section_name }}"
                                                    data-course-name="{{ $g->course_name }}"
                                                >
                                                    <i class='material-icons'>edit</i>
                                                </button>
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

    {{-- MODAL EDITAR CALIFICACIONES --}}
    <div class="modal fade" id="editGradeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #005187;">
                    <h5 class="modal-title text-white">
                        <i class="material-icons align-middle">edit</i>
                        EDITAR CALIFICACIONES:
                        <span id="edit_span_seccion" class="fw-bold"></span>
                        <br>
                        <small id="edit_span_curso"></small>
                    </h5>
                    <button 
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <form action="{{ route('grades.update') }}" method="POST" id="formEditGrades">
                    @csrf
                    <input type="hidden" name="idsection" id="edit_hidden_section">
                    <input type="hidden" name="idcourse" id="edit_hidden_course">

                    <div class="modal-body">
                        {{-- SELECT EVALUACIÓN --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    Tipo de Evaluación
                                </label>
                                <select 
                                    name="idevaluation_type"
                                    id="edit_evaluation_type"
                                    class="form-select"
                                    style="border-color: #005187;"
                                    required>
                                    <option value="">
                                        -- Seleccione --
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="tablaEditGradesModal">
                                <thead class="table-light">
                                    <tr>
                                        <th width="80">FOTO</th>
                                        <th>ALUMNO</th>
                                        <th width="180">CALIFICACIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            Seleccione un tipo de evaluación
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button 
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            CANCELAR
                        </button>
                        <button 
                            type="submit"
                            class="btn text-white px-4" 
                            style="background-color: #005187;">
                            ACTUALIZAR NOTAS
                        </button>
                    </div>
                </form>
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

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                const editModal = new bootstrap.Modal('#editGradeModal');

                // ABRIR MODAL
                $('.btn-edit-grades').on('click', function() {
                    const idsection = $(this).data('section');
                    const idcourse = $(this).data('course');
                    const sectionName = $(this).data('section-name');
                    const courseName = $(this).data('course-name');

                    // SETEAMOS
                    $('#edit_hidden_section').val(idsection);
                    $('#edit_hidden_course').val(idcourse);
                    $('#edit_span_seccion').text(sectionName);
                    $('#edit_span_curso').text(courseName);

                    // LIMPIAMOS TABLA
                    $('#tablaEditGradesModal tbody').html(`
                        <tr>
                            <td colspan="3" class="text-center">
                                Seleccione un tipo de evaluación
                            </td>
                        </tr>
                    `);

                    // CARGAR TIPOS EVALUACIÓN
                    $.get("{{ route('grades.getEvaluationTypes') }}", function(data) {
                        let select = $('#edit_evaluation_type');
                        select.empty();
                        select.append(`
                            <option value="">
                                -- Seleccione --
                            </option>
                        `);

                        data.forEach(item => {
                            select.append(`
                                <option value="${item.idevaluation_type}">
                                    ${item.evaluation_name}
                                </option>
                            `);
                        });
                    });

                    editModal.show();
                });

                // CAMBIO DE TIPO EVALUACIÓN
                $('#edit_evaluation_type').on('change', function() {
                    const idevaluation_type = $(this).val();
                    const idsection = $('#edit_hidden_section').val();
                    const idcourse = $('#edit_hidden_course').val();
                    let tbody = $('#tablaEditGradesModal tbody');

                    tbody.html(`
                        <tr>
                            <td colspan="3" class="text-center py-4">
                                Cargando alumnos...
                            </td>
                        </tr>
                    `);

                    $.get("{{ route('grades.getEditData') }}", {
                        idsection: idsection,
                        idcourse: idcourse,
                        idevaluation_type: idevaluation_type
                    }, function(data) {
                        tbody.empty();

                        if(data.length === 0) {
                            tbody.html(`
                                <tr>
                                    <td colspan="3" class="text-center">
                                        No hay alumnos registrados.
                                    </td>
                                </tr>
                            `);
                            return;
                        }

                        data.forEach(alumno => {
                            let foto = alumno.photo
                                ? `/backend/img/subidas/${alumno.photo}`
                                : `/backend/img/user-default.png`;

                            tbody.append(`
                                <tr>
                                    <td>
                                        <img 
                                            src="${foto}"
                                            width="45"
                                            height="45"
                                            class="rounded-circle shadow-sm"
                                            onerror="this.src='/backend/img/user-default.png'"
                                        >
                                    </td>
                                    <td>${alumno.full_name}</td>
                                    <td>
                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            max="20"
                                            class="form-control"
                                            name="notas[${alumno.idstudent}]"
                                            value="${alumno.grade ?? ''}"
                                        >
                                    </td>
                                </tr>
                            `);
                        });
                    });
                });

                // UPDATE
                $('#formEditGrades').on('submit', function(e) {
                    e.preventDefault();
                    const $form = $(this);

                    $.ajax({
                        url: $form.attr('action'),
                        method: 'POST',
                        data: $form.serialize(),
                        success: function(response) {
                            editModal.hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Actualizado',
                                text: 'Las notas fueron actualizadas.',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudieron actualizar las notas.'
                            });
                        }
                    });
                });
            });
        </script>
    @endpush

</x-layouts.admin-layout>