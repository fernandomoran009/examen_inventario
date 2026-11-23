-- ============================================
-- EXAMEN INTERCICLO - Desarrollo de Aplicaciones Web
-- Tema: Inventario de una tienda
-- ============================================

CREATE DATABASE IF NOT EXISTS examen_inventario;
USE examen_inventario;

-- Tabla de productos (F1: Modelo con PK y 4 atributos)
CREATE TABLE IF NOT EXISTS productos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    cantidad INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL
);

-- 3 registros ficticios para facilitar la revisión
INSERT INTO productos (nombre, categoria, cantidad, precio) VALUES
('Cuaderno A4', 'Papelería', 50, 1.50),
('Bolígrafo Azul', 'Papelería', 120, 0.75),
('Mochila Escolar', 'Accesorios', 15, 25.00);

-- Usuario de la aplicación (seguridad S4)
CREATE USER IF NOT EXISTS 'examen_user'@'localhost' IDENTIFIED BY '123456789';
GRANT SELECT, INSERT, UPDATE, DELETE ON examen_inventario.* TO 'examen_user'@'localhost';
FLUSH PRIVILEGES;