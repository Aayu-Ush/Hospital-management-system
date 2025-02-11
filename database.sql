CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password) VALUES ('admin', 'admin123');

CREATE TABLE doctors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone_no VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    department VARCHAR(100) NOT NULL
);

INSERT INTO doctors (name, email, phone_no, address, department) 
VALUES ('Aayush Khatiwada', 'aayush123@gmail.com', '9812344567', 'Gangabu, Kathmandu','Opthalmology');

INSERT INTO doctors (name, email, phone_no, address, department) 
VALUES ('Ashim Jung Kunwar', 'ashim123@gmail.com', '9809876547', 'Nepaltar, Kathmandu','Gynecology');

CREATE TABLE patients (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone_no VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    age INT NOT NULL
);

INSERT INTO patients (name, email, phone_no, address, age) 
VALUES ('Akash Kafle', 'akash3@gmail.com', '9809876543', 'Samakhusi, Kathmandu', 19);

INSERT INTO patients (name, email, phone_no, address, age) 
VALUES ('Dev Magar', 'devm3@gmail.com', '9809963543', 'Lainchour, Kathmandu', 24);

CREATE TABLE appointments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    status ENUM('Scheduled', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Scheduled',
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
);

SELECT a.id, p.name AS patient_name, d.name AS doctor_name, a.date, a.time, a.status
FROM appointments a
JOIN patients p ON a.patient_id = p.id
JOIN doctors d ON a.doctor_id = d.id;

INSERT INTO appointments (patient_id, doctor_id, date, time, status) 
VALUES 
(1, 1, '2025-02-10', '10:30:00', 'Scheduled'),
(1, 2, '2025-02-12', '14:00:00', 'Scheduled'),
(2, 1, '2025-02-15', '09:00:00', 'Completed'),
(2, 2, '2025-02-18', '11:45:00', 'Cancelled');
