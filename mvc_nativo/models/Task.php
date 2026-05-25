<?php

require_once dirname(__DIR__) . '/libs/Database.php';

class Task {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllByUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM tareas WHERE usuario_id = :usuario_id ORDER BY created_at DESC");
        $stmt->execute(['usuario_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function findByIdAndUser($id, $userId) {
        $stmt = $this->db->prepare("SELECT * FROM tareas WHERE id = :id AND usuario_id = :usuario_id LIMIT 1");
        $stmt->execute([
            'id' => $id,
            'usuario_id' => $userId
        ]);
        return $stmt->fetch();
    }

    public function create($userId, $titulo, $descripcion) {
        $stmt = $this->db->prepare("INSERT INTO tareas (usuario_id, titulo, descripcion, estado) VALUES (:usuario_id, :titulo, :descripcion, 'pendiente')");
        return $stmt->execute([
            'usuario_id' => $userId,
            'titulo' => $titulo,
            'descripcion' => $descripcion
        ]);
    }

    public function update($id, $userId, $titulo, $descripcion, $estado) {
        $stmt = $this->db->prepare("UPDATE tareas SET titulo = :titulo, descripcion = :descripcion, estado = :estado WHERE id = :id AND usuario_id = :usuario_id");
        return $stmt->execute([
            'id' => $id,
            'usuario_id' => $userId,
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'estado' => $estado
        ]);
    }

    public function delete($id, $userId) {
        $stmt = $this->db->prepare("DELETE FROM tareas WHERE id = :id AND usuario_id = :usuario_id");
        return $stmt->execute([
            'id' => $id,
            'usuario_id' => $userId
        ]);
    }

    public function toggleStatus($id, $userId) {
        $task = $this->findByIdAndUser($id, $userId);
        if (!$task) {
            return false;
        }
        $newStatus = ($task['estado'] === 'pendiente') ? 'completada' : 'pendiente';
        $stmt = $this->db->prepare("UPDATE tareas SET estado = :estado WHERE id = :id AND usuario_id = :usuario_id");
        if ($stmt->execute([
            'estado' => $newStatus,
            'id' => $id,
            'usuario_id' => $userId
        ])) {
            return $newStatus;
        }
        return false;
    }
}
