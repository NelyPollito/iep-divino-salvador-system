<x-layouts.admin-layout title="Mensajes enviados">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}">Panel Control</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Mensajes enviados
                    </li>
                </ol>
            </nav>

            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Mensajes enviados</h4>
                    <p class="card-category">
                        Mensajes enviados por el usuario actual.
                    </p>
                </div>

                <div class="card-content table-responsive">

                    <div class="mb-3">
                        <a href="{{ route('messages.create') }}" class="btn btn-light btn-sm">
                            Nuevo mensaje
                        </a>

                        <a href="{{ route('messages.inbox') }}" class="btn btn-light btn-sm">
                            Bandeja de entrada
                        </a>

                        <a href="{{ route('messages.sent') }}" class="btn btn-primary btn-sm text-white">
                            Enviados
                        </a>
                    </div>

                    @forelse($messages as $message)

                        @if($loop->first)
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Destinatario</th>
                                        <th>Tipo</th>
                                        <th>Asunto</th>
                                        <th>Mensaje</th>
                                        <th>Fecha de envío</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                        @endif

                                    <tr>
                                        <td>
                                            <strong>
                                                {{ $message->receiver->username ?? 'Usuario no disponible' }}
                                            </strong>
                                            <br>
                                            <small>
                                                {{ $message->receiver->email ?? '' }}
                                            </small>
                                        </td>

                                        <td>
                                            {{ $message->type }}
                                        </td>

                                        <td>
                                            {{ $message->subject }}
                                        </td>

                                        <td>
                                            {{ \Illuminate\Support\Str::limit($message->body, 60) }}
                                        </td>

                                        <td>
                                            {{ $message->created_at->format('d/m/Y H:i') }}
                                        </td>

                                        <td>
                                            <a href="{{ route('messages.show', $message->id) }}" class="btn btn-info btn-sm text-white">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>

                        @if($loop->last)
                                </tbody>
                            </table>
                        @endif

                    @empty

                        <div class="alert alert-info">
                            No has enviado mensajes por el momento.
                        </div>

                    @endforelse

                </div>
            </div>

        </div>
    </div>
</div>

</x-layouts.admin-layout>