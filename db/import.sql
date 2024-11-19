DROP TABLE IF EXISTS subjects;
DROP TABLE IF EXISTS choices;
DROP TABLE IF EXISTS Table1;

CREATE TABLE subjects (
    id INT PRIMARY KEY,
    subject VARCHAR(255),
    prompt TEXT,
    images LONGBLOB
);

CREATE TABLE choices (
    id INT PRIMARY KEY,
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

INSERT INTO subjects (id, subject, prompt) VALUES
(1, 'code', 'using modern libraries blah blah');

INSERT INTO choices (id, choice, prompt) VALUES
(1, 'debug', 'Zoek fout in code'),
(2, 'Geef lijst', 'Geef lijst code');

INSERT INTO tags (subject_id, choice_id) VALUES
(1, 1),
(1, 2);
