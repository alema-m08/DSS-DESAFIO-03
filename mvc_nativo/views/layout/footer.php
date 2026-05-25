    </main>

    <footer class="footer-container py-4 mt-auto border-top border-secondary-subtle">
        <div class="container text-center">
            <p class="mb-0 text-secondary-light small">&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?>. Todos los derechos reservados.</p>
            <p class="mb-0 text-secondary-light small font-monospace">Desarrollado para el Tercer Desafío Práctico (DSS)</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Custom AJAX helper if on dashboard -->
    <?php if (Session::isLoggedIn() && ($_SERVER['REQUEST_URI'] === '/dashboard' || strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false)): ?>
        <script src="<?php echo BASE_URL; ?>/public/js/ajax.js"></script>
    <?php endif; ?>
</body>
</html>
