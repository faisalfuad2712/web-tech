CREATE DATABASE IF NOT EXISTS university_library;
USE university_library;

CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author VARCHAR(120) NOT NULL,
    category VARCHAR(100) NOT NULL,
    status ENUM('Available', 'Unavailable') NOT NULL DEFAULT 'Available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO books (title, author, category, status) VALUES
('Introduction to Algorithms', 'Thomas H. Cormen', 'Computer Science', 'Available'),
('Clean Code', 'Robert C. Martin', 'Software Engineering', 'Unavailable'),
('Database System Concepts', 'Abraham Silberschatz', 'Database', 'Available');