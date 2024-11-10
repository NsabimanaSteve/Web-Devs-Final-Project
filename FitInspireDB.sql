-- Drop the database if it exists
-- ROP DATABASE IF EXISTS FitInspireDB;

-- Create the new database
CREATE DATABASE FitInspireDB;
USE FitInspireDB;

-- 1. Memberships Table Definition
CREATE TABLE Memberships (
    membership_id INT PRIMARY KEY AUTO_INCREMENT,
    membership_type VARCHAR(50),
    price DECIMAL(10, 2),
    duration INT, -- duration in months
    description VARCHAR(255)
);

-- 2. User Roles Table Definition
CREATE TABLE UserRoles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50)
);

-- 3. Trainers Table Definition
CREATE TABLE Trainers (
    trainer_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    specialization VARCHAR(50),
    phone_number VARCHAR(15),
    email VARCHAR(100),
    availability_schedule VARCHAR(255)
);

-- 4. Members Table Definition
CREATE TABLE Members (
    member_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    phone_number VARCHAR(15),
    membership_type INT,
    start_date DATE,
    end_date DATE,
    status VARCHAR(10),
    profile_picture VARCHAR(255),
    address VARCHAR(255),
    FOREIGN KEY (membership_type) REFERENCES Memberships(membership_id)
);

-- 5. Classes Table Definition
CREATE TABLE Classes (
    class_id INT PRIMARY KEY AUTO_INCREMENT,
    class_name VARCHAR(50),
    class_description VARCHAR(255),
    instructor_id INT,
    schedule_date DATE,
    start_time TIME,
    end_time TIME,
    max_capacity INT,
    location VARCHAR(50),
    FOREIGN KEY (instructor_id) REFERENCES Trainers(trainer_id)
);

-- 6. Class Attendance Table Definition
CREATE TABLE ClassAttendance (
    attendance_id INT PRIMARY KEY AUTO_INCREMENT,
    class_id INT,
    member_id INT,
    attendance_status VARCHAR(10),
    booking_date DATE,
    FOREIGN KEY (class_id) REFERENCES Classes(class_id),
    FOREIGN KEY (member_id) REFERENCES Members(member_id)
);

-- 7. Payments Table Definition
CREATE TABLE Payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    member_id INT,
    amount DECIMAL(10, 2),
    payment_date DATE,
    payment_method VARCHAR(50),
    status VARCHAR(10),
    transaction_reference VARCHAR(100),
    FOREIGN KEY (member_id) REFERENCES Members(member_id)
);

-- 8. Personal Training Sessions Table Definition
CREATE TABLE PersonalTrainingSessions (
    session_id INT PRIMARY KEY AUTO_INCREMENT,
    member_id INT,
    trainer_id INT,
    session_date DATE,
    start_time TIME,
    end_time TIME,
    session_notes VARCHAR(255),
    FOREIGN KEY (member_id) REFERENCES Members(member_id),
    FOREIGN KEY (trainer_id) REFERENCES Trainers(trainer_id)
);

-- 9. Motivational Quotes Table Definition
CREATE TABLE MotivationalQuotes (
    quote_id INT PRIMARY KEY AUTO_INCREMENT,
    quote_text VARCHAR(255),
    author VARCHAR(50),
    category VARCHAR(50),
    member_id INT,
    date_added DATE,
    FOREIGN KEY (member_id) REFERENCES Members(member_id)
);

-- 10. Admin Users Table Definition
CREATE TABLE AdminUsers (
    admin_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    password_hash VARCHAR(255),
    email VARCHAR(100),
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES UserRoles(role_id)
);

-- 11. Class Feedback Table Definition
CREATE TABLE ClassFeedback (
    feedback_id INT PRIMARY KEY AUTO_INCREMENT,
    class_id INT,
    member_id INT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comments VARCHAR(255),
    FOREIGN KEY (class_id) REFERENCES Classes(class_id),
    FOREIGN KEY (member_id) REFERENCES Members(member_id)
);

-- 12. Gym Equipment Table Definition
CREATE TABLE GymEquipment (
    equipment_id INT PRIMARY KEY AUTO_INCREMENT,
    equipment_name VARCHAR(50),
    maintenance_status VARCHAR(20),
    last_maintenance_date DATE
);

-- Sample Data Inserts

-- Insert initial data into Memberships table
INSERT INTO Memberships (membership_type, price, duration, description) VALUES 
('Monthly', 50.00, 1, 'One month of unlimited access'),
('Yearly', 500.00, 12, 'One year of unlimited access'),
('Weekly', 15.00, 1, 'One week trial access');

-- Insert initial data into UserRoles table
INSERT INTO UserRoles (role_name) VALUES 
('Admin'), 
('Manager'), 
('Trainer');

-- Insert sample data into Trainers table
INSERT INTO Trainers (first_name, last_name, specialization, phone_number, email, availability_schedule) VALUES 
('Alice', 'Smith', 'Yoga', '0987654321', 'alice@fitness.com', 'Mon-Wed-Fri: 10 AM - 2 PM'),
('Bob', 'Johnson', 'Personal Trainer', '0123456789', 'bob@fitness.com', 'Tue-Thu-Sat: 8 AM - 1 PM');

-- Insert sample data into GymEquipment table
INSERT INTO GymEquipment (equipment_name, maintenance_status, last_maintenance_date) VALUES 
('Treadmill', 'available', '2024-01-10'),
('Elliptical Machine', 'under maintenance', '2024-06-15'),
('Stationary Bike', 'available', '2024-08-20');

-- Insert sample data into Members table
INSERT INTO Members (first_name, last_name, email, phone_number, membership_type, start_date, end_date, status, profile_picture, address) VALUES 
('John', 'Doe', 'john@gmail.com', '1234567890', 1, '2024-01-01', '2024-12-31', 'active', 'profile1.jpg', '123 Fitness St.'),
('Jane', 'Roe', 'jane@gmail.com', '0987654321', 2, '2024-03-01', '2025-03-01', 'active', 'profile2.jpg', '456 Workout Ave.');

-- Test Queries

-- Select active members
SELECT * FROM Members WHERE status = 'active';


-- Update member contact information
UPDATE Members 
SET email = 'alice.newemail@gmail.com', phone_number = '4321432143' 
WHERE member_id = 1;

-- Delete a member
DELETE FROM Members WHERE member_id = 1;
SELECT * FROM Members WHERE status = 'active';

-- Join query for Class Attendance with member and class details
SELECT ca.attendance_id, m.first_name, m.last_name, c.class_name, ca.attendance_status 
FROM ClassAttendance ca 
JOIN Members m ON ca.member_id = m.member_id 
JOIN Classes c ON ca.class_id = c.class_id;

-- Query to count members per membership type
SELECT ms.membership_type, COUNT(*) AS member_count 
FROM Members m 
JOIN Memberships ms ON m.membership_type = ms.membership_id 
GROUP BY ms.membership_type;
