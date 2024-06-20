CREATE DATABASE IF NOT EXISTS ehos;

USE ehos;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    type_user ENUM('user', 'administrator') DEFAULT 'user'
);

INSERT INTO users (name, email, password, type_user) VALUES
('lue', 'lue@ehos.com', '$2y$10$Q1Y9G0Cq2hYv3GzReiIuruvM5eFUXSki5AwG9nTpMK28QGBmM3vTO', 'administrator');

INSERT INTO users (name, email, password, type_user) VALUES
('sol', 'sol@ehos.com', '$2y$10$Q1Y9G0Cq2hYv3GzReiIuruvM5eFUXSki5AwG9nTpMK28QGBmM3vTO', 'user');
