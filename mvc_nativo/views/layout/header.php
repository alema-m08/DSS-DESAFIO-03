<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . " - " . APP_NAME : APP_NAME; ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/styles.css">
</head>
<body>
    
    
    <?php if (Session::isLoggedIn()): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-glass border-bottom border-secondary-subtle py-3 mb-4 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo BASE_URL; ?>/dashboard">
                <div class="brand-logo-container me-2">
                    <i class="fa-solid fa-list-check fs-4 text-gradient"></i>
                </div>
                <span class="fw-bold tracking-tight text-white"><?php echo APP_NAME; ?></span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars text-white fs-4"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 rounded-pill <?php echo ($_SERVER['REQUEST_URI'] === '/dashboard' || strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'active bg-white bg-opacity-10 text-white' : 'text-secondary-light'; ?>" href="<?php echo BASE_URL; ?>/dashboard">
                            <i class="fa-solid fa-table-columns me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 px-3 rounded-pill <?php echo (strpos($_SERVER['REQUEST_URI'], 'crear') !== false) ? 'active bg-white bg-opacity-10 text-white' : 'text-secondary-light'; ?>" href="<?php echo BASE_URL; ?>/tareas/crear">
                            <i class="fa-solid fa-circle-plus me-1"></i> Nueva Tarea
                        </a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="user-profile-badge d-flex align-items-center bg-white bg-opacity-5 px-3 py-2 rounded-pill border border-secondary-subtle">
                        <div class="profile-avatar-mini me-2 d-flex align-items-center justify-content-center text-white bg-primary bg-gradient rounded-circle">
                            <?php echo strtoupper(substr(Session::getUserName(), 0, 1)); ?>
                        </div>
                        <span class="text-white fw-semibold small"><?php echo htmlspecialchars(Session::getUserName()); ?></span>
                    </div>
                    <a href="<?php echo BASE_URL; ?>/logout" class="btn btn-logout rounded-pill px-3 py-2 btn-sm" id="logout-btn">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Salir
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <main class="page-container mb-5">
