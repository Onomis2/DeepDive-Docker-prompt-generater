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
('code', 'using modern libraries like PHP 8.2.12, ECMAScript 2023, python 3.14, Lua 5.4.7, SQL Server 2022, phpMyAdmin 5.2 and others;'),
('cooking', 'Using basic equipment like ovens, microwaves, toasters, and barbeques to prepare meals and snacks;'),
('storytelling', 'Exploring modern storytelling techniques like structuring a narrative, crafting compelling plots, if applicable developing multidimensional characters, and if applicable using tools such as Scrivener, Campfire, or Final Draft;'),
('art', 'Creating art using basic tools like pencils, brushes, paints, and clay, and exploring fundamental concepts of design;'),
('history', 'Understanding historical events, timelines, and their significance using basic resources like textbooks, maps, and documents;');

INSERT INTO choices (choice, prompt) VALUES
/*1*/('Debug a script or error', 'I need help debugging a specific error or bug in my code. Please assist me with finding the issue and providing potential fixes for it:'),
/*2*/('Give a list of functions',

 'Can you provide a list of useful functions for the following language(s) that are applicable for the following:'),
/*3*/('Give a method of coding', 'Please suggest coding techniques or approaches to solve the following problem/issue in:'),
/*4*/('Give a detailed explaination', 'Can you provide a detailed explanation of the following:'),
/*5*/('Analyse code', 'Analyze this code snippet:'),
/*6*/('Give recipe', 'Please provide a recipe for the following:'),
/*7*/('Explain a cooking technique', 'Can you explain the following cooking technique in detail, including steps and tips for execution:'),
/*8*/('Suggest a meal plan', 'Please suggest a meal plan for the following dietary preferences or restrictions:'),
/*9*/('Recommend substitutions', 'What are some alternatives or substitutions for the following ingredient(s):'),
/*10*/('Suggest ingredient use', 'Can you explain how the following ingredient is typically used in cooking and any important tips or considerations:'),
/*11*/('Suggest character traits', 'Please suggest character traits for a protagonist or supporting character based on the following setting or genre:'),
/*12*/('Describe a plot twist', 'Can you suggest a compelling plot twist for the following story idea:'),
/*13*/('Generate dialogue', 'Please write a dialogue exchange between characters in the following context:'),
/*14*/('Build a world', 'Can you provide a framework or suggestions for building a fictional world with the following parameters:'),
/*15*/('Explain an art style', 'Can you explain the characteristics of the following art style and how to emulate it:'),
/*16*/('Suggest an excercize', 'What are some exercises or drills to improve skills in the following area of art:'),
/*17*/('Provide inspiration', 'Can you suggest themes, references, or ideas that could serve as inspiration for the following type of artwork or style:'),
/*18*/('Explain historical event', 'Please provide a detailed explanation of the following historical event, including its causes, key figures, and consequences:'),
/*19*/('Analyze historical figure', 'Can you analyze the actions and significance of the following historical figure:'),
/*20*/('Compare historical periods/events', 'Can you compare and contrast the following two historical periods or events:'),
/*21*/('Provide a timeline', 'Can you provide a detailed timeline for the following historical topic or era:'),
/*22*/('Explain historical invention', 'Please provide a detailed explanation of the following invention, including its origin, inventor(s), purpose, impact, and subsequent developments:');

INSERT INTO tags (subject_id, choice_id) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(4, 15),
(4, 16),
(4, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22);

INSERT INTO users (username, password) VALUES
('admin', '$2y$10$dU8n53kNNv4tzUUloptXSeH.2V914dhfB9Xaq.qgZnWLEOw9Vnq0y');