<x-layouts.admin-layout title="Resumen de Asistencias">
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Asistencias</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-header card-header-text d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Resumen de Asistencia por Sección</h4>
                        <a href="{{ route('attendance.create') }}" class="btn btn-danger text-white">
                            <i class="material-icons">add</i>
                        </a>
                    </div>

                    <div class="card-content table-responsive p-4">
                        @if($attendances->count() > 0)
                            <table class="table table-hover" id="example">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Periodo</th>
                                        <th>Fecha</th>
                                        <th>Sección</th>
                                        <th>Curso</th>
                                        <th>Resumen (P / T / A)</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendances as $row)
                                        <tr>
                                            <td><span class="badge badge-dq3">{{ $row->period_name }}</span></td>
                                            <td>{{ \Carbon\Carbon::parse($row->attendance_date)->format('d/m/Y') }}</td>
                                            <td><span>{{ $row->section_name }}</span></td>
                                            <td><span class="badge badge-success">{{ $row->course_name }}</span></td>
                                            <td>
                                                <span class="badge badge-dbe" title="Presentes">{{ $row->total_presentes }} P</span>
                                                <span class="badge badge-dq3" title="Tardanzas">{{ $row->total_tardanzas }} T</span>
                                                <span class="badge badge-danger" title="Ausentes">{{ $row->total_ausentes }} A</span>
                                            </td>
                                            <td><strong>{{ $row->total_students }}</strong></td>
                                            <td>
                                                <a href="javascript:void(0)" 
                                                    class="btn btn-warning btn-sm btn-edit-attendance" 
                                                    data-date="{{ $row->attendance_date }}" 
                                                    data-section="{{ $row->idsection }}"
                                                    data-section-name="{{ $row->section_name }}">
                                                        <i class="material-icons">edit</i>
                                                </a>

                                                <a href="javascript:void(0)" 
                                                    class="btn btn-info btn-sm btn-show-attendance" 
                                                    data-date="{{ $row->attendance_date }}" 
                                                    data-section="{{ $row->idsection }}"
                                                    data-section-name="{{ $row->section_name }}">
                                                        <i class="material-icons">visibility</i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning">
                                <strong>No hay registros de asistencia!</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAttendanceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #005187;">
                    <h5 class="modal-title text-white">
                        <i class="material-icons align-middle">edit</i> 
                        EDITAR ASISTENCIA: <span id="edit_span_seccion" class="fw-bold"></span>
                        <br><small>Fecha: <span id="edit_span_fecha"></span></small>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('attendance.update') }}" method="POST" id="formEditAsistencia">
                    @csrf
                    <input type="hidden" name="attendance_date" id="edit_hidden_date">
                    <input type="hidden" name="seccion" id="edit_hidden_section">

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="tablaEditAlumnosModal">
                                <thead class="table-light">
                                    <tr>
                                        <th>FOTO</th>
                                        <th>NOMBRE DEL ALUMNO</th>
                                        <th width="200">ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                        <button type="submit" class="btn text-white px-4" style="background-color: #005187;">ACTUALIZAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoAttendanceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #005187;">
                    <h5 class="modal-title text-white">
                        <i class="material-icons align-middle">info</i> 
                        DETALLES DE ASISTENCIA: <span id="info_span_seccion" class="fw-bold"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span><strong>Fecha:</strong> <span id="info_span_fecha"></span></span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle" id="tablaInfoAlumnos">
                            <thead class="table-light">
                                <tr>
                                    <th>FOTO</th>
                                    <th>ALUMNO</th>
                                    <th class="text-center">ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
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

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            const editModal = new bootstrap.Modal('#editAttendanceModal');

            $('.btn-edit-attendance').on('click', function() {
                const idsection = $(this).data('section');
                const date = $(this).data('date');
                const sectionName = $(this).data('section-name');


                $('#edit_hidden_date').val(date);
                $('#edit_hidden_section').val(idsection);
                $('#edit_span_seccion').text(sectionName);
                $('#edit_span_fecha').text(date);

                let tbody = $('#tablaEditAlumnosModal tbody');
                tbody.empty().append('<tr><td colspan="3" class="text-center py-4">Cargando datos...</td></tr>');

                editModal.show();

                $.get("{{ route('attendance.getEditData') }}", { 
                    idsection: idsection, 
                    attendance_date: date 
                }, function(data) {
                    tbody.empty();

                    if(data.length === 0) {
                        tbody.append('<tr><td colspan="3" class="text-center">No se encontraron alumnos.</td></tr>');
                        return;
                    }

                    data.forEach(alumno => {
                        let fotoPath = alumno.photo 
                            ? `/backend/img/subidas/${alumno.photo}` 
                            : `/backend/img/user-default.png`;

                        tbody.append(`
                            <tr>
                                <td>
                                    <img src="${fotoPath}" width="60" height="60" class="rounded-circle shadow-sm" 
                                        onerror="this.src='/backend/img/user-default.png'">
                                </td>
                                <td>${alumno.full_name}</td>
                                <td>
                                    <select name="asistencias[${alumno.idstudent}]" class="form-select border-warning">
                                        <option value="PRESENTE" ${alumno.status === 'PRESENTE' ? 'selected' : ''}>Presente</option>
                                        <option value="AUSENTE" ${alumno.status === 'AUSENTE' ? 'selected' : ''}>Ausente</option>
                                        <option value="TARDANZA" ${alumno.status === 'TARDANZA' ? 'selected' : ''}>Tardanza</option>
                                    </select>
                                </td>
                            </tr>
                        `);
                    });
                }).fail(function() {
                    tbody.html('<tr><td colspan="3" class="text-center text-danger">Error al cargar los datos.</td></tr>');
                });
            });

            $('#formEditAsistencia').on('submit', function(e) {
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
                            title: '¡Actualizado!',
                            text: 'Los registros se actualizaron correctamente.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al guardar los cambios.'
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            const infoModal = new bootstrap.Modal('#infoAttendanceModal');

            $('.btn-show-attendance').on('click', function() {
                const idsection = $(this).data('section');
                const date = $(this).data('date');
                const sectionName = $(this).data('section-name');

                $('#info_span_seccion').text(sectionName);
                $('#info_span_fecha').text(date);

                let tbody = $('#tablaInfoAlumnos tbody');
                tbody.empty().append('<tr><td colspan="3" class="text-center">Cargando detalles...</td></tr>');

                infoModal.show();

                $.get("{{ route('attendance.showDetails') }}", { 
                    idsection: idsection, 
                    attendance_date: date 
                }, function(data) {
                    tbody.empty();

                    data.forEach(item => {
                        let foto = item.photo ? `/backend/img/subidas/${item.photo}` : `/backend/img/user-default.png`;
                        
                        // Determinar color del badge
                        let badgeClass = '';
                        if(item.status === 'PRESENTE') badgeClass = 'badge bg-success';
                        else if(item.status === 'AUSENTE') badgeClass = 'badge bg-danger';
                        else badgeClass = 'badge bg-warning text-dark';

                        tbody.append(`
                            <tr>
                                <td>
                                    <img src="${foto}" width="40" height="40" class="rounded-circle" onerror="this.src='/backend/img/user-default.png'">
                                </td>
                                <td>${item.full_name}</td>
                                <td class="text-center">
                                    <span class="${badgeClass}">${item.status}</span>
                                </td>
                            </tr>
                        `);
                    });
                });
            });
        });
    </script>

    @endpush

</x-layouts.admin-layout>