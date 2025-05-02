CREATE DATABASE restaurante;

USE restaurante;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  rol ENUM('user', 'admin') NOT NULL DEFAULT 'user'
);

CREATE TABLE ordenes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  pedido TEXT NOT NULL,
  fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Usuario admin (user: admin, pass: admin123)
INSERT INTO usuarios (username, password, rol) 
VALUES ('admin', SHA2('admin123', 256), 'admin');

-- Usuario normal (user: juan, pass: juan123)
INSERT INTO usuarios (username, password, rol) 
VALUES ('juan', SHA2('juan123', 256), 'user');
