CREATE DATABASE IF NOT EXISTS webtech;
USE webtech;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL
);

INSERT INTO users (username, password, email) VALUES
('abc', '123', 'abc@aiub.edu'),
('xyz', '123', 'xyz@aiub.edu'),
('alamin', '123', 'alamin@aiub.edu'),
('test', '123', 'test@aiub.edu'),
('pqr', '123', 'pqr@aiub.edu');
