<div class="container d-flex align-items-center justify-content-center min-vh-80 my-5">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">

            <!-- Success/Error Banners -->
            <?php if (Session::hasFlash('error')): ?>
                <div class="alert alert-danger border-0 shadow-lg text-white mb-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2 fs-5"></i>
                    <div><?php echo Session::getFlash('error'); ?></div>
                </div>
            <?php endif; ?>

            <?php 
                $errors = Session::getFlash('errors') ?? []; 
                $old = Session::getFlash('old') ?? [];
            ?>

            <div class="card bg-glass border-secondary-subtle shadow-xl overflow-hidden rounded-4 animate-fade-in">
                <!-- Decorative Top line -->
                <div class="bg-primary bg-gradient-vertical py-1 w-100"></div>

                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="brand-logo-large mx-auto mb-3 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user-plus text-gradient fs-1"></i>
                        </div>
                        <h2 class="h3 fw-bold text-white tracking-tight">Crea tu cuenta</h2>
                        <p class="text-secondary-light small">Únete a TaskOrganizer y organiza tu día a día</p>
                    </div>

                    <form action="<?php echo BASE_URL; ?>/registro" method="POST" id="register-form" novalidate>
                        <!-- Name Input -->
                        <div class="form-group mb-3">
                            <label for="nombre" class="form-label text-white small fw-medium">Nombre Completo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white bg-opacity-5 border-secondary-subtle border-end-0 text-secondary-light">
                                    <i class="fa-regular fa-user"></i>
                                </span>
                                <input type="text" class="form-control bg-white bg-opacity-5 border-secondary-subtle border-start-0 text-white <?php echo isset($errors['nombre']) ? 'is-invalid' : ''; ?>" id="nombre" name="nombre" placeholder="Juan Pérez" value="<?php echo htmlspecialchars($old['nombre'] ?? ''); ?>" required>
                                <?php if (isset($errors['nombre'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['nombre']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label text-white small fw-medium">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white bg-opacity-5 border-secondary-subtle border-end-0 text-secondary-light">
                                    <i class="fa-regular fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control bg-white bg-opacity-5 border-secondary-subtle border-start-0 text-white <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="nombre@empresa.com" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>" required>
                                <?php if (isset($errors['email'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label text-white small fw-medium">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white bg-opacity-5 border-secondary-subtle border-end-0 text-secondary-light">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" class="form-control bg-white bg-opacity-5 border-secondary-subtle border-start-0 text-white <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Mínimo 6 caracteres" required>
                                <?php if (isset($errors['password'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-group mb-4">
                            <label for="confirm_password" class="form-label text-white small fw-medium">Confirmar Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white bg-opacity-5 border-secondary-subtle border-end-0 text-secondary-light">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </span>
                                <input type="password" class="form-control bg-white bg-opacity-5 border-secondary-subtle border-start-0 text-white <?php echo isset($errors['confirm_password']) ? 'is-invalid' : ''; ?>" id="confirm_password" name="confirm_password" placeholder="Repite tu contraseña" required>
                                <?php if (isset($errors['confirm_password'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['confirm_password']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary bg-gradient-vertical w-100 py-2.5 rounded-pill fw-bold text-white shadow border-0" id="register-submit-btn">
                            <i class="fa-solid fa-user-plus me-2"></i>Registrar Cuenta
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-secondary-light small mb-0">¿Ya tienes cuenta? 
                            <a href="<?php echo BASE_URL; ?>/login" class="text-primary fw-semibold text-decoration-none" id="login-link">Inicia sesión</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
