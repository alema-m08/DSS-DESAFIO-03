@extends('layout.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="row justify-content-center align-items-center min-vh-80">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5 animate-fade-in">
        <div class="card bg-glass shadow-xl rounded-4 p-4 p-sm-5 border border-light border-opacity-10">
            <div class="text-center mb-4">
                <i class="fa-solid fa-layer-group text-gradient fs-1 mb-3"></i>
                <h2 class="fw-bold tracking-tight text-white mb-1">¡Bienvenido de nuevo!</h2>
                <p class="text-secondary-light">Ingresa tus datos para acceder a tus tareas.</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 text-white fs-7 py-2 px-3" style="background-color: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.2) !important;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary-light fs-7 uppercase tracking-wider fw-bold">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-secondary-light border border-light border-opacity-10">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" name="email" id="email" class="form-control border-start-0" placeholder="tu@correo.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="form-label text-secondary-light fs-7 uppercase tracking-wider fw-bold">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-secondary-light border border-light border-opacity-10">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" class="form-control border-start-0" placeholder="••••••••" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary bg-gradient-vertical border-0 w-100 py-3 rounded-3 fw-bold text-white shadow-sm mb-3">
                    Iniciar Sesión
                </button>
            </form>

            <div class="text-center mt-3">
                <p class="text-secondary-light fs-7 mb-0">
                    ¿No tienes una cuenta? 
                    <a href="{{ route('register') }}" class="text-gradient fw-bold text-decoration-none transition-all">Regístrate gratis</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
