@extends('layout.app')

@section('title', 'Mis Tareas')

@section('content')
<div class="row align-items-center mb-5 animate-fade-in">
    <div class="col-12 col-md-6 mb-3 mb-md-0">
        <h1 class="fw-bold tracking-tight text-white mb-1">Panel de Tareas</h1>
        <p class="text-secondary-light mb-0">Organiza tus actividades diarias de manera eficiente.</p>
    </div>
    <div class="col-12 col-md-6 text-md-end">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary bg-gradient-vertical border-0 px-4 py-2-5 rounded-3 fw-bold text-white shadow-sm d-inline-flex align-items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Nueva Tarea</span>
        </a>
    </div>
</div>

<div class="row g-4 mb-5 animate-fade-in" style="animation-delay: 0.1s">
    <div class="col-12 col-sm-4">
        <div class="card bg-glass rounded-4 p-4 border border-light border-opacity-10">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary-light fs-7 uppercase tracking-wider fw-bold">Tareas Totales</span>
                    <h3 class="fw-bold text-white mt-1 mb-0" id="stat-total">{{ count($tasks) }}</h3>
                </div>
                <div class="stat-icon-wrapper" style="background: rgba(99, 102, 241, 0.1); color: var(--primary-color)">
                    <i class="fa-solid fa-list-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="card bg-glass rounded-4 p-4 border border-light border-opacity-10">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary-light fs-7 uppercase tracking-wider fw-bold">Pendientes</span>
                    <h3 class="fw-bold text-warning mt-1 mb-0" id="stat-pending">
                        {{ $tasks->where('estado', 'pendiente')->count() }}
                    </h3>
                </div>
                <div class="stat-icon-wrapper" style="background: rgba(245, 158, 11, 0.1); color: var(--warning-color)">
                    <i class="fa-regular fa-clock fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="card bg-glass rounded-4 p-4 border border-light border-opacity-10">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary-light fs-7 uppercase tracking-wider fw-bold">Completadas</span>
                    <h3 class="fw-bold text-success mt-1 mb-0" id="stat-completed">
                        {{ $tasks->where('estado', 'completada')->count() }}
                    </h3>
                </div>
                <div class="stat-icon-wrapper" style="background: rgba(16, 185, 129, 0.1); color: var(--success-color)">
                    <i class="fa-regular fa-circle-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="animate-fade-in" style="animation-delay: 0.2s">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div class="d-flex gap-2">
            <button class="btn btn-filter px-3 py-1-5 rounded-3 text-secondary-light fw-semibold fs-7 active" data-filter="all">Todas</button>
            <button class="btn btn-filter px-3 py-1-5 rounded-3 text-secondary-light fw-semibold fs-7" data-filter="pendiente">Pendientes</button>
            <button class="btn btn-filter px-3 py-1-5 rounded-3 text-secondary-light fw-semibold fs-7" data-filter="completada">Completadas</button>
        </div>
        <div class="text-secondary-light fs-7">
            Mostrando <span id="visible-count">{{ count($tasks) }}</span> de {{ count($tasks) }} tareas
        </div>
    </div>

    
    <div class="card bg-glass rounded-4 p-5 text-center border border-light border-opacity-10 {{ count($tasks) > 0 ? 'd-none' : '' }}" id="empty-state">
        <div class="py-4">
            <i class="fa-regular fa-folder-open text-secondary-light fs-1 mb-3 opacity-50"></i>
            <h4 class="text-white fw-bold mb-2">No tienes tareas creadas</h4>
            <p class="text-secondary-light col-lg-6 mx-auto mb-4">Comienza agregando tu primera actividad para organizarte de forma más productiva.</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary bg-gradient-vertical border-0 px-4 py-2-5 rounded-3 fw-bold text-white shadow-sm">
                Crear mi primera tarea
            </a>
        </div>
    </div>

    
    <div class="row g-4" id="tasks-grid">
        @foreach($tasks as $task)
            <div class="col-12 col-md-6 col-lg-4 task-card-item" data-status="{{ $task->estado }}" id="task-card-{{ $task->id }}">
                <div class="card bg-glass rounded-4 p-4 hover-card border border-light border-opacity-10 h-100 d-flex flex-column justify-content-between">
                    <div>
                        
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="form-check d-flex align-items-center gap-1">
                                <input class="form-check-input check-status-ajax" type="checkbox" 
                                       data-id="{{ $task->id }}" 
                                       {{ $task->estado === 'completada' ? 'checked' : '' }}
                                       id="check-{{ $task->id }}">
                            </div>
                            <span class="badge text-uppercase tracking-wider px-2-5 py-1-5 rounded-3 fs-7 status-badge {{ $task->estado === 'completada' ? 'bg-success bg-opacity-10 text-success border border-success border-opacity-25' : 'bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25' }}">
                                {{ $task->estado }}
                            </span>
                        </div>

                        
                        <h4 class="fw-bold text-white mb-2 task-title {{ $task->estado === 'completada' ? 'text-decoration-line-through text-opacity-50' : '' }}">
                            {{ $task->titulo }}
                        </h4>
                        <p class="text-secondary-light fs-7 mb-4 task-desc text-break {{ $task->estado === 'completada' ? 'text-opacity-50' : '' }}">
                            {{ $task->descripcion ?: 'Sin descripción' }}
                        </p>
                    </div>

                    
                    <div class="d-flex align-items-center justify-content-between pt-3 border-top border-light border-opacity-10 mt-auto">
                        <span class="text-secondary-light fs-7 d-flex align-items-center gap-1.5">
                            <i class="fa-regular fa-calendar"></i>
                            <span>{{ $task->created_at->format('d/m/Y') }}</span>
                        </span>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-action rounded-3" title="Editar Tarea">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-action btn-outline-danger rounded-3" title="Eliminar Tarea">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const filterButtons = document.querySelectorAll('.btn-filter');
    const taskCards = document.querySelectorAll('.task-card-item');
    const visibleCountEl = document.getElementById('visible-count');
    const emptyState = document.getElementById('empty-state');
    const tasksGrid = document.getElementById('tasks-grid');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function () {

            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');
            let visibleCount = 0;

            taskCards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (filterValue === 'all' || cardStatus === filterValue) {
                    card.classList.remove('d-none');
                    visibleCount++;
                } else {
                    card.classList.add('d-none');
                }
            });

            visibleCountEl.textContent = visibleCount;


            if (visibleCount === 0) {
                if (filterValue === 'all') {
                    emptyState.classList.remove('d-none');
                    tasksGrid.classList.add('d-none');
                } else {

                    emptyState.classList.add('d-none');
                    tasksGrid.classList.remove('d-none');
                }
            } else {
                emptyState.classList.add('d-none');
                tasksGrid.classList.remove('d-none');
            }
        });
    });


    const checkboxes = document.querySelectorAll('.check-status-ajax');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const taskId = this.getAttribute('data-id');
            const card = document.getElementById('task-card-' + taskId);
            const titleEl = card.querySelector('.task-title');
            const descEl = card.querySelector('.task-desc');
            const badgeEl = card.querySelector('.status-badge');


            const isChecked = this.checked;


            fetch(`{{ url('tareas/toggle') }}/${taskId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error de servidor al actualizar estado.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {

                    card.setAttribute('data-status', data.estado);


                    if (data.estado === 'completada') {
                        titleEl.classList.add('text-decoration-line-through', 'text-opacity-50');
                        descEl.classList.add('text-opacity-50');
                        
                        badgeEl.textContent = 'COMPLETADA';
                        badgeEl.className = 'badge text-uppercase tracking-wider px-2-5 py-1-5 rounded-3 fs-7 status-badge bg-success bg-opacity-10 text-success border border-success border-opacity-25';
                    } else {
                        titleEl.classList.remove('text-decoration-line-through', 'text-opacity-50');
                        descEl.classList.remove('text-opacity-50');
                        
                        badgeEl.textContent = 'PENDIENTE';
                        badgeEl.className = 'badge text-uppercase tracking-wider px-2-5 py-1-5 rounded-3 fs-7 status-badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25';
                    }


                    updateStats();
                    

                    const activeFilter = document.querySelector('.btn-filter.active').getAttribute('data-filter');
                    if (activeFilter !== 'all' && activeFilter !== data.estado) {
                        card.classList.add('d-none');

                        let currentVisible = parseInt(visibleCountEl.textContent);
                        visibleCountEl.textContent = currentVisible - 1;
                    }


                    showToast(data.message, 'success');
                } else {

                    this.checked = !isChecked;
                    showToast('No se pudo actualizar el estado de la tarea.', 'error');
                }
            })
            .catch(error => {
                console.error(error);

                this.checked = !isChecked;
                showToast('Error al conectar con el servidor.', 'error');
            });
        });
    });


    function updateStats() {
        const total = taskCards.length;
        let pending = 0;
        let completed = 0;

        taskCards.forEach(card => {
            const status = card.getAttribute('data-status');
            if (status === 'pendiente') pending++;
            else if (status === 'completada') completed++;
        });

        document.getElementById('stat-total').textContent = total;
        document.getElementById('stat-pending').textContent = pending;
        document.getElementById('stat-completed').textContent = completed;
    }


    function showToast(message, type) {

        const container = document.querySelector('.toast-container');
        if (container) container.remove();

        const toastHtml = `
            <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
                <div class="toast align-items-center text-white border-0 show animate-fade-in toast-\${type}" role="alert">
                    <div class="d-flex">
                        <div class="toast-body d-flex align-items-center gap-2">
                            <i class="fa-solid \${type === 'success' ? 'fa-circle-check' : 'fa-circle-xmark'} fs-5"></i>
                            <span>\${message}</span>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', toastHtml);

        const newToastEl = document.querySelector('.toast-container .toast');
        setTimeout(() => {
            const bsToast = bootstrap.Toast.getInstance(newToastEl) || newToastEl.remove();
        }, 5000);
    }
});
</script>
@endsection
