@extends('layout.app')

@section('title', 'Nueva Tarea')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8 animate-fade-in">
        <!-- Navigation Header -->
        <div class="mb-4">
            <a href="{{ route('dashboard') }}" class="text-secondary-light text-decoration-none d-inline-flex align-items-center gap-2 hover-opacity">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Volver al panel</span>
            </a>
        </div>

        <div class="card bg-glass shadow-xl rounded-4 p-4 p-sm-5 border border-light border-opacity-10">
            <h2 class="fw-bold tracking-tight text-white mb-2">Crear Nueva Tarea</h2>
            <p class="text-secondary-light mb-5">Define el título y descripción de tu nueva actividad.</p>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 text-white fs-7 py-2 px-3 mb-4" style="background-color: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.2) !important;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                
                <!-- Title Field -->
                <div class="mb-4">
                    <label for="titulo" class="form-label text-secondary-light fs-7 uppercase tracking-wider fw-bold">Título de la Tarea</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ej. Comprar materiales de oficina" value="{{ old('titulo') }}" required autofocus>
                </div>

                <!-- Description Field -->
                <div class="mb-5">
                    <label for="descripcion" class="form-label text-secondary-light fs-7 uppercase tracking-wider fw-bold">Descripción (Opcional)</label>
                    <textarea name="descripcion" id="descripcion" rows="5" class="form-control" placeholder="Describe los detalles de la tarea aquí...">{{ old('descripcion') }}</textarea>
                </div>

                <!-- Buttons Actions -->
                <div class="d-flex align-items-center justify-content-end gap-3 flex-wrap">
                    <a href="{{ route('dashboard') }}" class="btn btn-logout px-4 py-2-5 rounded-3 fw-bold">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary bg-gradient-vertical border-0 px-4 py-2-5 rounded-3 fw-bold text-white shadow-sm">
                        Crear Tarea
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
