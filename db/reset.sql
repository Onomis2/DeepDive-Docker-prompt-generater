ALTER TABLE tags DROP FOREIGN KEY tags_ibfk_1;
ALTER TABLE tags DROP FOREIGN KEY tags_ibfk_2;

DROP TABLE IF EXISTS subjects;
DROP TABLE IF EXISTS choices;
DROP TABLE IF EXISTS tags;
DROP TABLE IF EXISTS users;

CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255),
    prompt TEXT,
    images LONGBLOB
);

CREATE TABLE choices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    choice VARCHAR(255),
    prompt TEXT
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_id INT,
    choice_id INT,
    FOREIGN KEY (subject_id) REFERENCES subjects(id),
    FOREIGN KEY (choice_id) REFERENCES choices(id)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255)
);

INSERT INTO subjects (subject, prompt) VALUES
('code', 'using modern libraries like PHP 8.2.12, ECMAScript 2023, python 3.14, Lua 5.4.7, SQL Server 2022, phpMyAdmin 5.2 and others;');

INSERT INTO choices (id, choice, prompt) VALUES
(1, 'debug een script of error', 'I need help debugging a specific error or bug in my code. Please assist me with finding the issue and providing potential fixes for it:'),
(2, 'Geef lijst van functies', 'Can you provide a list of useful functions for the following language(s) that are applicable for the following:');
(3, 'Geef een manier om te coderen', 'Please suggest coding techniques or approaches to solve the following problem/issue in:');
(4, 'Geef een uitleg', 'Can you provide a detailed explanation of the following:');

INSERT INTO tags (subject_id, choice_id) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

INSERT INTO users (username, password) VALUES
('admin', '$2y$10$dU8n53kNNv4tzUUloptXSeH.2V914dhfB9Xaq.qgZnWLEOw9Vnq0y');