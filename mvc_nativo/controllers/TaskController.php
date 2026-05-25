<?php

require_once dirname(__DIR__) . '/libs/Session.php';
require_once dirname(__DIR__) . '/models/Task.php';

class TaskController {
    private $taskModel;
    private $userId;

    public function __construct() {
        Session::start();
        if (!Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $this->taskModel = new Task();
        $this->userId = Session::getUserId();
    }

    public function index() {
        $tasks = $this->taskModel->getAllByUser($this->userId);
        $title = "Panel de Tareas";
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/tasks/dashboard.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    public function create() {
        $title = "Crear Nueva Tarea";
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/tasks/create.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    public function store() {
        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');

        $errors = [];
        if (empty($titulo)) {
            $errors['titulo'] = "El título de la tarea es requerido.";
        }

        if (empty($errors)) {
            if ($this->taskModel->create($this->userId, $titulo, $descripcion)) {
                Session::setFlash('success', "¡Tarea creada exitosamente!");
                header('Location: ' . BASE_URL . '/dashboard');
                exit;
            } else {
                Session::setFlash('error', "No se pudo crear la tarea.");
            }
        } else {
            Session::setFlash('errors', $errors);
            Session::setFlash('old', ['titulo' => $titulo, 'descripcion' => $descripcion]);
        }

        header('Location: ' . BASE_URL . '/tareas/crear');
        exit;
    }

    public function edit($params) {
        $id = $params['id'] ?? null;
        $task = $this->taskModel->findByIdAndUser($id, $this->userId);

        if (!$task) {
            Session::setFlash('error', "La tarea no existe o no tienes acceso.");
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $title = "Editar Tarea";
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/tasks/edit.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    public function update($params) {
        $id = $params['id'] ?? null;
        $task = $this->taskModel->findByIdAndUser($id, $this->userId);

        if (!$task) {
            Session::setFlash('error', "La tarea no existe o no tienes acceso.");
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $estado = $_POST['estado'] ?? 'pendiente';

        $errors = [];
        if (empty($titulo)) {
            $errors['titulo'] = "El título es requerido.";
        }
        if (!in_array($estado, ['pendiente', 'completada'])) {
            $errors['estado'] = "Estado no válido.";
        }

        if (empty($errors)) {
            if ($this->taskModel->update($id, $this->userId, $titulo, $descripcion, $estado)) {
                Session::setFlash('success', "¡Tarea actualizada exitosamente!");
                header('Location: ' . BASE_URL . '/dashboard');
                exit;
            } else {
                Session::setFlash('error', "No se pudo actualizar la tarea.");
            }
        } else {
            Session::setFlash('errors', $errors);
        }

        header('Location: ' . BASE_URL . '/tareas/editar/' . $id);
        exit;
    }

    public function delete($params) {
        $id = $params['id'] ?? null;
        if ($this->taskModel->delete($id, $this->userId)) {
            Session::setFlash('success', "¡Tarea eliminada exitosamente!");
        } else {
            Session::setFlash('error', "No se pudo eliminar la tarea.");
        }
        header('Location: ' . BASE_URL . '/dashboard');
        exit;
    }

    public function toggle($params) {
        $id = $params['id'] ?? null;
        $newStatus = $this->taskModel->toggleStatus($id, $this->userId);

        header('Content-Type: application/json');
        if ($newStatus) {
            echo json_encode([
                'success' => true,
                'estado' => $newStatus,
                'message' => 'El estado de la tarea ha sido actualizado.'
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'No se pudo actualizar el estado.'
            ]);
        }
        exit;
    }
}
