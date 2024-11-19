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
('code', 'using modern libraries blah blah');

INSERT INTO choices (id, choice, prompt) VALUES
(1, 'debug', 'Zoek fout in code'),
(2, 'Geef lijst', 'Geef lijst code');

INSERT INTO tags (subject_id, choice_id) VALUES
(1, 1),
(1, 2);

INSERT INTO users (username, password) VALUES
('admin', SHA2('bit_academy', 256));