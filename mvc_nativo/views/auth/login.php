<div class="container d-flex align-items-center justify-content-center min-vh-80 my-5">
    <div class="row w-100 justify-content-center">
        <div class="col-md-5 col-lg-4">
            
            
            <?php if (Session::hasFlash('success')): ?>
                <div class="alert alert-success border-0 shadow-lg text-white mb-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check me-2 fs-5"></i>
                    <div><?php echo Session::getFlash('success'); ?></div>
                </div>
            <?php endif; ?>
            
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
                
                <div class="bg-primary bg-gradient-vertical py-1 w-100"></div>

                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="brand-logo-large mx-auto mb-3 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-list-check text-gradient fs-1"></i>
                        </div>
                        <h2 class="h3 fw-bold text-white tracking-tight">¡Bienvenido de nuevo!</h2>
                        <p class="text-secondary-light small">Inicia sesión en tu cuenta de TaskOrganizer</p>
                    </div>

                    <form action="<?php echo BASE_URL; ?>/login" method="POST" id="login-form" novalidate>
                        
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

                        
                        <div class="form-group mb-4">
                            <label for="password" class="form-label text-white small fw-medium">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white bg-opacity-5 border-secondary-subtle border-end-0 text-secondary-light">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" class="form-control bg-white bg-opacity-5 border-secondary-subtle border-start-0 text-white <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="••••••••" required>
                                <?php if (isset($errors['password'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        
                        <button type="submit" class="btn btn-primary bg-gradient-vertical w-100 py-2.5 rounded-pill fw-bold text-white shadow border-0" id="login-submit-btn">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Ingresar
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-secondary-light small mb-0">¿No tienes cuenta? 
                            <a href="<?php echo BASE_URL; ?>/registro" class="text-primary fw-semibold text-decoration-none" id="register-link">Regístrate gratis</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
