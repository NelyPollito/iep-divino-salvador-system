<x-layouts.admin-layout title="Nuevo Subgrado Académico">

<div class="main-content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('subgrades.index') }}">Subgrado Académico</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
                </ol>
            </nav>

            <div class="card" style="min-height:485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Nuevo Subgrado</h4>
                </div>
                <div class="card-content">
                    <div class="alert alert-warning">
                        <strong>Estimado usuario!</strong> Los campos remarcados con <span class="text-danger">*</span> son necesarios.
                    </div>

                    <form action="{{ route('subgrades.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Seleccionar Grado <span class="text-danger">*</span></label>
                                    <select class="form-control" name="iddegree" required>
                                        <option value="">Seleccione el grado correspondiente...</option>
                                        @foreach($degrees as $degree)
                                            <option value="{{ $degree->iddegree }}">
                                                {{ $degree->semester->period->period_name }} - {{ $degree->degree_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted text-danger">Importante asignar el subgrado a un grado existente.</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Nombre del subgrado <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="subgrade_name" required placeholder="ejm: Sección A">
                                    <small class="form-text text-muted text-danger">Ejemplo: Inicial 5 años - "A", 1er Grado - "Único".</small>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success text-white">Añadir</button>
                                <a class="btn btn-danger text-white" href="{{ route('subgrades.index') }}">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layouts.admin-layout>