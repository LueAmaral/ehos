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
('lue', 'lue@ehos.com', PASSWORD_HASH('1234567890', PASSWORD_DEFAULT), 'administrator');

INSERT INTO users (name, email, password, type_user) VALUES
('sol', 'sol@ehos.com', PASSWORD_HASH('1234567890', PASSWORD_DEFAULT), 'user');