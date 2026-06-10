<x-layouts.admin-layout title="Nuevo mensaje">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Mensajería Interna
                    </li>
                </ol>
            </nav>

            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Nuevo mensaje</h4>
                    <p class="card-category">
                        Envía mensajes internos a docentes, estudiantes, apoderados o personal administrativo.
                    </p>
                </div>

                <div class="card-content table-responsive">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-warning">
                            <strong>Estimado usuario!</strong> Complete correctamente los campos obligatorios.
                        </div>
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('messages.create') }}" class="btn btn-primary btn-sm text-white">
                            Nuevo mensaje
                        </a>

                        <a href="{{ route('messages.inbox') }}" class="btn btn-light btn-sm">
                            Bandeja de entrada
                        </a>

                        <a href="{{ route('messages.sent') }}" class="btn btn-light btn-sm">
                            Enviados
                        </a>
                    </div>

                    <form action="{{ route('messages.store') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        Destinatario <span class="text-danger">*</span>
                                    </label>

                                    <select name="receiver_id" class="form-control" required>
                                        <option value="">Seleccione un destinatario</option>

                                        @foreach($users as $user)
                                            <option value="{{ $user->iduser }}" {{ old('receiver_id') == $user->iduser ? 'selected' : '' }}>
                                                {{ $user->username }} - {{ $user->email }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('receiver_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        Tipo de mensaje <span class="text-danger">*</span>
                                    </label>

                                    <select name="type" class="form-control" required>
                                        <option value="">Seleccione un tipo</option>

                                        <option value="Consulta académica" {{ old('type') == 'Consulta académica' ? 'selected' : '' }}>
                                            Consulta académica
                                        </option>

                                        <option value="Comunicado" {{ old('type') == 'Comunicado' ? 'selected' : '' }}>
                                            Comunicado
                                        </option>

                                        <option value="Recordatorio" {{ old('type') == 'Recordatorio' ? 'selected' : '' }}>
                                            Recordatorio
                                        </option>

                                        <option value="Aviso de asistencia" {{ old('type') == 'Aviso de asistencia' ? 'selected' : '' }}>
                                            Aviso de asistencia
                                        </option>

                                        <option value="Coordinación docente-apoderado" {{ old('type') == 'Coordinación docente-apoderado' ? 'selected' : '' }}>
                                            Coordinación docente-apoderado
                                        </option>
                                    </select>

                                    @error('type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                Asunto <span class="text-danger">*</span>
                            </label>

                            <input 
                                type="text" 
                                name="subject" 
                                class="form-control" 
                                required 
                                maxlength="150"
                                placeholder="Ingrese el asunto del mensaje"
                                value="{{ old('subject') }}"
                            >

                            @error('subject')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>
                                Mensaje <span class="text-danger">*</span>
                            </label>

                            <textarea 
                                name="body" 
                                class="form-control" 
                                rows="7" 
                                required
                                placeholder="Escriba el contenido del mensaje"
                            >{{ old('body') }}</textarea>

                            @error('body')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <hr>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success text-white">
                                Enviar mensaje
                            </button>

                            <button type="reset" class="btn btn-danger text-white">
                                Cancelar
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</x-layouts.admin-layout>