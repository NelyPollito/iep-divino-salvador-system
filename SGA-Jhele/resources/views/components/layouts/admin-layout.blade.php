<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Panel' }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/img/favicon.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/buttonsdataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/font.css') }}">
</head>

<body>
<div class="wrapper">
    <div class="body-overlay"></div>

    <!-- SIDEBAR -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>
                <img src="{{ asset('backend/img/favicon.png') }}" class="img-fluid" />
                <span>Divino Salvador</span>
            </h3>
        </div>

        <ul class="list-unstyled components">
            <li class="{{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}">
                    <i class="material-icons">dashboard</i> Panel Control
                </a>
            </li>

            <li class="#">
                <a href="#">
                    <i class="material-icons">calendar_month</i> Periodo Escolar
                </a>
            </li>

            <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <i class="material-icons">person</i> Usuarios
                </a>
            </li>

            <li class="{{ request()->routeIs('fathers.*') ? 'active' : '' }}">
                <a href="{{ route('fathers.index') }}">
                    <i class="material-icons">group</i> Padres
                </a>
            </li>

            <li class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                <a href="{{ route('teachers.index') }}">
                    <i class="material-icons">badge</i> Docentes
                </a>
            </li>

            <li class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
                <a href="{{ route('students.index') }}">
                    <i class="material-icons">face</i> Alumnos
                </a>
            </li>
            <li><a href="#"><i class="material-icons">school</i> Cursos</a></li>
            <li><a href="#"><i class="material-icons">square_foot</i> Grado</a></li>
            <li><a href="#"><i class="material-icons">history_edu</i> Subgrado</a></li>
            <li><a href="#"><i class="material-icons">card_membership</i> Sección</a></li>
            <li><a href="#"><i class="material-icons">event_available</i> Asistencias</a></li>
            <li><a href="#"><i class="material-icons">verified</i> Calificaciones</a></li>
            <li><a href="#"><i class="material-icons">schedule</i> Horarios</a></li>
        </ul>
    </nav>
    <!-- CONTENT -->
    <div id="content">

        <!-- NAVBAR -->
        <div class="top-navbar">
            <nav class="navbar navbar-expand-lg">
                <button type="button" id="sidebar-collapse" class="d-xl-block d-lg-block d-md-none d-none">
                    <span class="material-icons">arrow_back_ios</span>
                </button>

                <a class="navbar-brand" href="#">Panel Control</a>

                <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle">
                    <span class="material-icons">more_vert</span>
                </button>

                <div class="collapse navbar-collapse d-lg-block d-xl-block d-sm-none d-md-none d-none" id="navbarcollapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item dropdown active">
                            <a class="nav-link" href="#" data-bs-toggle="dropdown">
                                <span class="material-icons">person</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">Mi cuenta</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">Contraseña</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            Salir
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="material-icons">settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- CONTENIDO DINÁMICO -->
        <div class="container mt-4">
            {{ $slot }}
        </div>

    </div>
</div>

<!-- jQuery (solo una vez y antes de todo lo que lo use) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap (incluye Popper, no necesitas popper aparte) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="{{ asset('backend/js/datatable.js') }}"></script>
<script src="{{ asset('backend/js/datatablebuttons.js') }}"></script>
<script src="{{ asset('backend/js/jszip.js') }}"></script>
<script src="{{ asset('backend/js/pdfmake.js') }}"></script>
<script src="{{ asset('backend/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/js/buttonshtml5.js') }}"></script>
<script src="{{ asset('backend/js/buttonsprint.js') }}"></script>


<!-- Scripts personalizados -->
<script src="{{ asset('backend/js/letra.js') }}"></script>
<script src="{{ asset('backend/js/condn.js') }}"></script>

    <script>
        $(document).ready(function () {

            // DataTables
            if ($('#example').length) {
                $('#example').DataTable();
            }

            if ($('#example1').length) {
                $('#example1').DataTable();
            }

            // Sidebar toggle
            $("#sidebar-collapse").on('click', function() {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

            $(".more-button, .body-overlay").on('click', function() {
                $('#sidebar, .body-overlay').toggleClass('show-nav');
            });

        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

    @if(session('desactivado') == 'OK')
    <script>
        Swal.fire(
            '¡Desactivado!',
            'El registro ha sido desactivado con éxito.',
            'success'
        )
    </script>
    @endif


    @if(session('actualizado') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Actualizado!',
            text: 'El registro se modificó correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif


    @if(session('foto_actualizada') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Imagen Actualizada!',
            text: 'La foto de perfil se cambió correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif

    @if(session('creado') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Perfil Creado!',
            text: 'El usuario ha sido registrado y vinculado con éxito.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif

    @if(session('perfil_completado') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Perfil Vinculado!',
            text: 'Los datos del alumno se registraron correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif

    @if(session('perfil_docente') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Docente Registrado!',
            text: 'Los datos profesionales se vincularon correctamente.',
            confirmButtonColor: '#007bff',
        })
    </script>
    @endif

    @if(session('perfil_padre') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Perfil Familiar Listo!',
            text: 'Los datos del padre/apoderado han sido vinculados.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif
    @if(session('update_success') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Actualizado!',
            text: 'Los datos del alumno se actualizaron correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif

    @if(session('delete_success') == 'OK')
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Registro Desactivado',
            text: 'El alumno ha sido inhabilitado correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif
    @if(session('photo_success') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Foto Actualizada',
            text: 'La imagen de perfil se cambió correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif

    @if(session('deletee_success') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Desactivado',
            text: 'El docente ha sido desactivado correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif


    @if(session('updatee_success') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Actualizado!',
            text: 'Los datos del apoderado se actualizaron correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif

    @if(session('delete_successApo') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Desactivado',
            text: 'El apoderado ha sido desactivado correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif


    @if(session('dpassword_success') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Contraseña Actualizada!',
            text: 'La clave de acceso ha sido cambiada correctamente.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif

    @if(session('add_hijo_success') == 'OK')
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Alumno Agregado!',
            text: 'El alumno se ha vinculado correctamente al Apoderado.',
            confirmButtonColor: '#28a745',
        })
    </script>
    @endif



</body>
</html>