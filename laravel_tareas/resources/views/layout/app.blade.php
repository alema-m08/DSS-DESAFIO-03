<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TaskOrganizer') - Gestión de Tareas</title>
    
    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS (Dark Mode Optimized) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom Style System -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    
    @yield('styles')
</head>
<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg bg-glass border-bottom border-light border-opacity-10 py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-white fw-bold" href="{{ route('dashboard') }}">
                <div class="brand-logo-container">
                    <i class="fa-solid fa-layer-group text-gradient fs-5"></i>
                </div>
                <span class="fs-4">Task<span class="text-gradient">Organizer</span></span>
                <span class="badge fs-7 ms-2 py-1 px-2" style="background: rgba(212, 175, 55, 0.1); color: #e5c158; border: 1px solid rgba(212, 175, 55, 0.2)">Laravel</span>
            </a>
            
            @auth
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center gap-3 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <span class="text-secondary-light me-2 d-flex align-items-center gap-2">
                            <span class="rounded-circle profile-avatar-mini bg-gradient-vertical d-flex align-items-center justify-content-center text-white">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-logout px-3 py-2 rounded-3 d-flex align-items-center gap-2">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Salir</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 py-5">
        <div class="container">
            <!-- Toast System for Session Status Messages -->
            @if(session('success'))
                <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
                    <div class="toast align-items-center text-white border-0 show animate-fade-in toast-success" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body d-flex align-items-center gap-2">
                                <i class="fa-solid fa-circle-check fs-5"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
                    <div class="toast align-items-center text-white border-0 show animate-fade-in toast-error" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body d-flex align-items-center gap-2">
                                <i class="fa-solid fa-circle-xmark fs-5"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-top border-light border-opacity-10 py-4 mt-auto" style="background: rgba(5, 16, 14, 0.95);">
        <div class="container text-center">
            <p class="text-secondary-light mb-0 fs-7">
                &copy; {{ date('Y') }} TaskOrganizer. Desarrollado con Laravel + Bootstrap 5 + AJAX.
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-dismiss toasts after 5 seconds
        document.addEventListener('DOMContentLoaded', function () {
            var toasts = document.querySelectorAll('.toast');
            toasts.forEach(function (toastEl) {
                setTimeout(function() {
                    var bsToast = bootstrap.Toast.getInstance(toastEl);
                    if (!bsToast) bsToast = new bootstrap.Toast(toastEl);
                    bsToast.hide();
                }, 5000);
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
