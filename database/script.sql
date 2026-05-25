-- Script SQL para el Sistema de Gestión de Tareas (TaskOrganizer)

-- ==========================================
-- 1. Base de datos para MVC Nativo (taskorganizer_db)
-- ==========================================
CREATE DATABASE IF NOT EXISTS taskorganizer_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE taskorganizer_db;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla de tareas
CREATE TABLE IF NOT EXISTS tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NULL,
    estado ENUM('pendiente', 'completada') DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ==========================================
-- 2. Base de datos para Laravel (taskorganizer_laravel)
-- ==========================================
CREATE DATABASE IF NOT EXISTS taskorganizer_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
