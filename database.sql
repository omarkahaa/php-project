DROP DATABASE IF EXISTS flight_logbook_omar;
CREATE DATABASE flight_logbook_omar CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE flight_logbook_omar;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE flight_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    aircraft VARCHAR(100) NOT NULL,
    departure_airport VARCHAR(20) NOT NULL,
    arrival_airport VARCHAR(20) NOT NULL,
    flight_date DATE NOT NULL,
    duration_minutes INT NOT NULL,
    flight_type VARCHAR(40) NOT NULL,
    instructor_name VARCHAR(150),
    landings INT DEFAULT 0,
    remarks TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users(first_name, last_name, email, password) VALUES
('Omar', 'Kahkahni', 'student@epita.fr', '$2y$12$11kqI/E81aa4Rm/AZinwEuN06EZgQp6tfgUukTjOC9hsG3b2VtyX2');

INSERT INTO flight_records(user_id, aircraft, departure_airport, arrival_airport, flight_date, duration_minutes, flight_type, instructor_name, landings, remarks) VALUES
(1, 'Tecnam P2006T', 'GMMB', 'GMME', '2026-05-01', 75, 'IFR', 'Captain Martin', 1, 'Navigation flight with route briefing and approach preparation.'),
(1, 'Tecnam P2006T', 'GMME', 'GMMB', '2026-05-03', 70, 'IFR', 'Captain Martin', 1, 'Return flight with radio navigation and descent planning.'),
(1, 'TB-09', 'GMMB', 'GMMB', '2026-05-05', 45, 'VFR', 'Captain Ali', 5, 'Circuit practice and landing training.');
