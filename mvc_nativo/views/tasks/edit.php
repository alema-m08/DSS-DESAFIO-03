<div class="container py-4 d-flex justify-content-center">
    <div class="col-md-8 col-lg-6">

        
        <?php if (Session::hasFlash('error')): ?>
            <div class="alert alert-danger border-0 shadow-lg text-white mb-4 d-flex align-items-center animate-fade-in" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2 fs-5"></i>
                <div><?php echo Session::getFlash('error'); ?></div>
            </div>
        <?php endif; ?>

        <?php 
            $errors = Session::getFlash('errors') ?? []; 
        ?>

        <div class="card bg-glass border-secondary-subtle shadow-xl overflow-hidden rounded-4 animate-fade-in">
            
            <div class="bg-primary bg-gradient-vertical py-1 w-100"></div>

            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-outline-light btn-action btn-sm rounded-circle" id="back-btn">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div>
                        <h2 class="h3 fw-bold text-white mb-0 tracking-tight">Editar Tarea</h2>
                        <p class="text-secondary-light small mb-0">Modifica los detalles de tu actividad</p>
                    </div>
                </div>

                <form action="<?php echo BASE_URL; ?>/tareas/editar/<?php echo $task['id']; ?>" method="POST" id="edit-task-form" novalidate>
                    
                    
                    <div class="form-group mb-4">
                        <label for="titulo" class="form-label text-white small fw-medium">Título de la Tarea</label>
                        <input type="text" 
                               class="form-control bg-white bg-opacity-5 border-secondary-subtle text-white py-2.5 <?php echo isset($errors['titulo']) ? 'is-invalid' : ''; ?>" 
                               id="titulo" 
                               name="titulo" 
                               placeholder="Ej: Preparar presentación del proyecto" 
                               value="<?php echo htmlspecialchars($task['titulo']); ?>" 
                               required>
                        <?php if (isset($errors['titulo'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['titulo']; ?></div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="form-group mb-4">
                        <label for="descripcion" class="form-label text-white small fw-medium">Descripción (Opcional)</label>
                        <textarea class="form-control bg-white bg-opacity-5 border-secondary-subtle text-white py-2.5" 
                                  id="descripcion" 
                                  name="descripcion" 
                                  rows="4" 
                                  placeholder="Detalla los puntos importantes de esta tarea..."><?php echo htmlspecialchars($task['descripcion']); ?></textarea>
                    </div>

                    
                    <div class="form-group mb-4">
                        <label for="estado" class="form-label text-white small fw-medium">Estado de la Tarea</label>
                        <select class="form-select bg-white bg-opacity-5 border-secondary-subtle text-white py-2.5 <?php echo isset($errors['estado']) ? 'is-invalid' : ''; ?>" 
                                id="estado" 
                                name="estado" 
                                required>
                            <option value="pendiente" <?php echo $task['estado'] === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                            <option value="completada" <?php echo $task['estado'] === 'completada' ? 'selected' : ''; ?>>Completada</option>
                        </select>
                        <?php if (isset($errors['estado'])): ?>
                            <div class="invalid-feedback"><?php echo $errors['estado']; ?></div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="d-flex gap-3 mt-5">
                        <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-outline-light rounded-pill px-4 py-2.5 w-50 fw-semibold" id="cancel-edit-btn">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary bg-gradient-vertical rounded-pill px-4 py-2.5 w-50 fw-bold border-0 text-white shadow" id="submit-edit-btn">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
