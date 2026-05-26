<?php

require_once dirname(__DIR__) . '/libs/Session.php';
require_once dirname(__DIR__) . '/models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        Session::start();
        $this->userModel = new User();
    }

    public function showLogin() {
        if (Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
        $title = "Iniciar Sesión";
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/auth/login.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    public function login() {
        if (Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];
        if (empty($email)) {
            $errors['email'] = "El correo electrónico es requerido.";
        }
        if (empty($password)) {
            $errors['password'] = "La contraseña es requerida.";
        }

        if (empty($errors)) {
            $user = $this->userModel->findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                Session::set('user_id', $user['id']);
                Session::set('user_nombre', $user['nombre']);
                Session::set('user_email', $user['email']);
                header('Location: ' . BASE_URL . '/dashboard');
                exit;
            } else {
                Session::setFlash('error', "Credenciales incorrectas.");
            }
        } else {
            Session::setFlash('errors', $errors);
        }

        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    public function showRegister() {
        if (Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
        $title = "Registro de Usuario";
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/auth/register.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    public function register() {
        if (Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        $errors = [];
        if (empty($nombre)) {
            $errors['nombre'] = "El nombre es requerido.";
        }
        if (empty($email)) {
            $errors['email'] = "El correo electrónico es requerido.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El formato de correo no es válido.";
        } else {
            $existing = $this->userModel->findByEmail($email);
            if ($existing) {
                $errors['email'] = "Este correo electrónico ya está registrado.";
            }
        }

        if (empty($password)) {
            $errors['password'] = "La contraseña es requerida.";
        } elseif (strlen($password) < 6) {
            $errors['password'] = "La contraseña debe tener al menos 6 caracteres.";
        }

        if ($password !== $confirm_password) {
            $errors['confirm_password'] = "Las contraseñas no coinciden.";
        }

        if (empty($errors)) {
            if ($this->userModel->create($nombre, $email, $password)) {
                Session::setFlash('success', "Registro exitoso. ¡Inicia sesión ahora!");
                header('Location: ' . BASE_URL . '/login');
                exit;
            } else {
                Session::setFlash('error', "Ocurrió un error al procesar el registro.");
            }
        } else {
            Session::setFlash('errors', $errors);
            Session::setFlash('old', ['nombre' => $nombre, 'email' => $email]);
        }

        header('Location: ' . BASE_URL . '/registro');
        exit;
    }

    public function logout() {
        Session::destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
