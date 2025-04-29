-- Crear base de datos
CREATE DATABASE IF NOT EXISTS sistema_pedidos DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE sistema_pedidos;

-- Crear tabla usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('user', 'admin') DEFAULT 'user'
);

-- Crear tabla ordenes
CREATE TABLE IF NOT EXISTS ordenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    pedido TEXT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Insertar usuario admin por defecto (usuario: admin / contraseña: admin123)
INSERT INTO usuarios (username, password, rol)
VALUES ('admin', '$2y$10$GgZ1qbEEDt0vjWz1kFT1N.ytLo7nWZdFGQbxVqxtuT.qH1dRuyj6u', 'admin');

-- Password hasheada ("admin123")