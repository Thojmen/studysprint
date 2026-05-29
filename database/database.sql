CREATE DATABASE studysprint;
USE studysprint;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    deadline DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    assigned_to VARCHAR(100),
    status ENUM('todo', 'doing', 'done') DEFAULT 'todo',
    due_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

INSERT INTO users (username, email, password)
VALUES (
    'Admin',
    'admin@test.nl',
    '$2y$10$abcdefghijklmnopqrstuv'
);

INSERT INTO projects (user_id, title, deadline)
VALUES
(1, 'Webshop Project', '2026-06-10'),
(1, 'Portfolio Website', '2026-06-20');

INSERT INTO tasks (project_id, title, description, assigned_to, status, due_date)
VALUES
(1, 'Database maken', 'Maak MySQL database structuur', 'Sam', 'todo', '2026-06-01'),
(1, 'Login systeem', 'PHP login bouwen', 'Alex', 'doing', '2026-06-02'),
(1, 'CSS styling', 'Dashboard stijlen toevoegen', 'Sam', 'done', '2026-05-30');