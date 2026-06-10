<x-layouts.admin-layout title="Detalle del mensaje">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('messages.inbox') }}">Mensajería</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Detalle del mensaje
                    </li>
                </ol>
            </nav>

            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Detalle del mensaje</h4>
                    <p class="card-category">
                        Visualización completa del mensaje interno seleccionado.
                    </p>
                </div>

                <div class="card-content">

                    <div class="mb-3">
                        <a href="{{ route('messages.create') }}" class="btn btn-light btn-sm">
                            Nuevo mensaje
                        </a>

                        <a href="{{ route('messages.inbox') }}" class="btn btn-light btn-sm">
                            Bandeja de entrada
                        </a>

                        <a href="{{ route('messages.sent') }}" class="btn btn-light btn-sm">
                            Enviados
                        </a>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Remitente:</strong><br>
                                {{ $message->sender->username ?? 'Usuario no disponible' }}
                                <br>
                                <small>{{ $message->sender->email ?? '' }}</small>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p>
                                <strong>Destinatario:</strong><br>
                                {{ $message->receiver->username ?? 'Usuario no disponible' }}
                                <br>
                                <small>{{ $message->receiver->email ?? '' }}</small>
                            </p>
                        </div>
                    </div>

                    <p>
                        <strong>Tipo de mensaje:</strong><br>
                        {{ $message->type }}
                    </p>

                    <p>
                        <strong>Asunto:</strong><br>
                        {{ $message->subject }}
                    </p>

                    <p>
                        <strong>Fecha de envío:</strong><br>
                        {{ $message->created_at->format('d/m/Y H:i') }}
                    </p>

                    <p>
                        <strong>Estado:</strong><br>
                        @if($message->read_at)
                            <span class="badge bg-success">
                                Leído el {{ $message->read_at->format('d/m/Y H:i') }}
                            </span>
                        @else
                            <span class="badge bg-warning text-dark">
                                No leído
                            </span>
                        @endif
                    </p>

                    <hr>

                    <div class="form-group">
                        <label>
                            <strong>Mensaje:</strong>
                        </label>

                        <div class="border rounded p-3 bg-light">
                            {!! nl2br(e($message->body)) !!}
                        </div>
                    </div>

                    <hr>

                    <a href="{{ route('messages.inbox') }}" class="btn btn-primary btn-sm text-white">
                        Volver a bandeja de entrada
                    </a>

                    <a href="{{ route('messages.sent') }}" class="btn btn-light btn-sm">
                        Volver a enviados
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>

</x-layouts.admin-layout>