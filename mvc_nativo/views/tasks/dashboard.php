<div class="container py-4">
    
    <!-- Toast/Notification Banner -->
    <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
        <!-- Dynamically populated via AJAX js -->
    </div>

    <!-- PHP Success/Error Banners -->
    <?php if (Session::hasFlash('success')): ?>
        <div class="alert alert-success border-0 shadow-lg text-white mb-4 d-flex align-items-center animate-fade-in" role="alert">
            <i class="fa-solid fa-circle-check me-2 fs-5"></i>
            <div><?php echo Session::getFlash('success'); ?></div>
        </div>
    <?php endif; ?>
    
    <?php if (Session::hasFlash('error')): ?>
        <div class="alert alert-danger border-0 shadow-lg text-white mb-4 d-flex align-items-center animate-fade-in" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2 fs-5"></i>
            <div><?php echo Session::getFlash('error'); ?></div>
        </div>
    <?php endif; ?>

    <!-- Welcome & Action Header -->
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h1 class="h2 fw-bold text-white tracking-tight">Mis Tareas</h1>
            <p class="text-secondary-light mb-0">Gestiona, organiza y realiza tus actividades asignadas.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="<?php echo BASE_URL; ?>/tareas/crear" class="btn btn-primary bg-gradient-vertical px-4 py-2.5 rounded-pill border-0 shadow-lg fw-bold text-white" id="create-task-btn">
                <i class="fa-solid fa-plus me-2"></i>Nueva Tarea
            </a>
        </div>
    </div>

    <!-- Quick Statistics Row -->
    <?php
        $totalTasks = count($tasks);
        $completedTasks = 0;
        foreach ($tasks as $t) {
            if ($t['estado'] === 'completada') {
                $completedTasks++;
            }
        }
        $pendingTasks = $totalTasks - $completedTasks;
    ?>
    <div class="row g-4 mb-5">
        <!-- Total Tasks -->
        <div class="col-md-4">
            <div class="card bg-glass border-secondary-subtle rounded-4 p-3 shadow" id="stat-total">
                <div class="d-flex align-items-center">
                    <div class="stat-icon-wrapper bg-primary bg-opacity-10 text-primary me-3">
                        <i class="fa-solid fa-clipboard-list fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary-light mb-1 small fw-medium uppercase tracking-wider">Total Tareas</h6>
                        <span class="h3 fw-bold text-white" id="stat-total-count"><?php echo $totalTasks; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Completed Tasks -->
        <div class="col-md-4">
            <div class="card bg-glass border-secondary-subtle rounded-4 p-3 shadow" id="stat-completed">
                <div class="d-flex align-items-center">
                    <div class="stat-icon-wrapper bg-success bg-opacity-10 text-success me-3">
                        <i class="fa-solid fa-circle-check fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary-light mb-1 small fw-medium uppercase tracking-wider">Completadas</h6>
                        <span class="h3 fw-bold text-success" id="stat-completed-count"><?php echo $completedTasks; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Tasks -->
        <div class="col-md-4">
            <div class="card bg-glass border-secondary-subtle rounded-4 p-3 shadow" id="stat-pending">
                <div class="d-flex align-items-center">
                    <div class="stat-icon-wrapper bg-warning bg-opacity-10 text-warning me-3">
                        <i class="fa-solid fa-clock-rotate-left fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-secondary-light mb-1 small fw-medium uppercase tracking-wider">Pendientes</h6>
                        <span class="h3 fw-bold text-warning" id="stat-pending-count"><?php echo $pendingTasks; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Filter & Content -->
    <div class="card bg-glass border-secondary-subtle rounded-4 shadow overflow-hidden">
        <div class="card-header border-secondary-subtle bg-white bg-opacity-5 p-3">
            <div class="row align-items-center g-3">
                <div class="col-md-6">
                    <h5 class="text-white mb-0 fw-semibold">Listado de Actividades</h5>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="btn-group btn-group-sm rounded-pill p-1 bg-white bg-opacity-5 border border-secondary-subtle" role="group" aria-label="Filters">
                        <button type="button" class="btn btn-filter active rounded-pill px-3 py-1.5 text-white fw-medium border-0" data-filter="todas">Todas</button>
                        <button type="button" class="btn btn-filter rounded-pill px-3 py-1.5 text-secondary-light fw-medium border-0" data-filter="pendientes">Pendientes</button>
                        <button type="button" class="btn btn-filter rounded-pill px-3 py-1.5 text-secondary-light fw-medium border-0" data-filter="completadas">Completadas</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <?php if (empty($tasks)): ?>
                <div class="text-center py-5">
                    <div class="empty-state-icon mb-3 text-secondary-light">
                        <i class="fa-solid fa-list-check fs-1"></i>
                    </div>
                    <h5 class="text-white fw-semibold">No tienes tareas registradas</h5>
                    <p class="text-secondary-light small">Comienza creando tu primera actividad con el botón "Nueva Tarea".</p>
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-md-2 g-4" id="tasks-container">
                    <?php foreach ($tasks as $task): ?>
                        <div class="col task-card-item" data-status="<?php echo $task['estado']; ?>" id="task-card-<?php echo $task['id']; ?>">
                            <div class="card bg-glass bg-opacity-5 border-secondary-subtle h-100 rounded-3 shadow-sm hover-card transition-all">
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <!-- Header: Checkbox status and title -->
                                        <div class="d-flex align-items-start justify-content-between mb-2">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="checkbox-wrapper">
                                                    <input type="checkbox" 
                                                           class="form-check-input task-toggle-checkbox border-secondary-subtle" 
                                                           id="task-toggle-<?php echo $task['id']; ?>" 
                                                           data-id="<?php echo $task['id']; ?>" 
                                                           data-url="<?php echo BASE_URL; ?>/tareas/toggle/<?php echo $task['id']; ?>"
                                                           <?php echo $task['estado'] === 'completada' ? 'checked' : ''; ?>>
                                                </div>
                                                <h5 class="card-title text-white mb-0 fw-semibold task-title <?php echo $task['estado'] === 'completada' ? 'text-decoration-line-through text-opacity-50' : ''; ?>" id="task-title-<?php echo $task['id']; ?>">
                                                    <?php echo htmlspecialchars($task['titulo']); ?>
                                                </h5>
                                            </div>
                                            <!-- Badge -->
                                            <span class="badge badge-status rounded-pill px-2.5 py-1.5 fs-7 <?php echo $task['estado'] === 'completada' ? 'bg-success bg-opacity-10 text-success border border-success border-opacity-25' : 'bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25'; ?>" id="task-badge-<?php echo $task['id']; ?>">
                                                <?php echo ucfirst($task['estado']); ?>
                                            </span>
                                        </div>

                                        <!-- Description -->
                                        <p class="card-text text-secondary-light small mt-3 mb-4 task-desc <?php echo $task['estado'] === 'completada' ? 'text-opacity-50' : ''; ?>" id="task-desc-<?php echo $task['id']; ?>">
                                            <?php echo nl2br(htmlspecialchars($task['descripcion'] ?: 'Sin descripción adicional.')); ?>
                                        </p>
                                    </div>

                                    <!-- Actions Footer -->
                                    <div class="d-flex align-items-center justify-content-between border-top border-secondary-subtle pt-3 mt-auto">
                                        <span class="text-secondary-light small font-monospace">
                                            <i class="fa-regular fa-calendar me-1"></i> <?php echo date('d M Y, h:i a', strtotime($task['created_at'])); ?>
                                        </span>
                                        <div class="d-flex gap-2">
                                            <a href="<?php echo BASE_URL; ?>/tareas/editar/<?php echo $task['id']; ?>" class="btn btn-outline-light btn-action btn-sm rounded-circle" id="edit-task-<?php echo $task['id']; ?>" title="Editar Tarea">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="<?php echo BASE_URL; ?>/tareas/eliminar/<?php echo $task['id']; ?>" method="POST" id="delete-form-<?php echo $task['id']; ?>" onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?');" class="d-inline">
                                                <button type="submit" class="btn btn-outline-danger btn-action btn-sm rounded-circle" id="delete-task-<?php echo $task['id']; ?>" title="Eliminar Tarea">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
