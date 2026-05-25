<?php

require_once dirname(__DIR__) . '/libs/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($nombre, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
        return $stmt->execute([
            'nombre' => $nombre,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }
}
