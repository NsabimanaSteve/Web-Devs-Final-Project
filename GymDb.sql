-- Drop the database if it exists
DROP DATABASE IF EXISTS GymDB;

-- Create the new database
CREATE DATABASE GymDB;
USE GymDB;

-- 1. Members Table Definition
CREATE TABLE Members (
    member_id INT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    phone_number VARCHAR(15),
    membership_type INT,
    start_date DATE,
    end_date DATE,
    status VARCHAR(10),
    profile_picture VARCHAR(255),
    address VARCHAR(255)
);

-- 2. Memberships Table Definition
CREATE TABLE Memberships (
    membership_id INT PRIMARY KEY,
    membership_type VARCHAR(50),
    price DECIMAL(10, 2),
    duration INT, -- duration in months
    description VARCHAR(255)
);

-- 3. Classes Table Definition
CREATE TABLE Classes (
    class_id INT PRIMARY KEY,
    class_name VARCHAR(50),
    class_description VARCHAR(255),
    instructor_id INT,
    schedule_date DATE,
    start_time TIME,
    end_time TIME,
    max_capacity INT,
    location VARCHAR(50)
);

-- 4. Class Attendance Table Definition
CREATE TABLE ClassAttendance (
    attendance_id INT PRIMARY KEY,
    class_id INT,
    member_id INT,
    attendance_status VARCHAR(10),
    booking_date DATE,
    FOREIGN KEY (class_id) REFERENCES Classes(class_id),
    FOREIGN KEY (member_id) REFERENCES Members(member_id)
);

-- 5. Trainers Table Definition
CREATE TABLE Trainers (
    trainer_id INT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    specialization VARCHAR(50),
    phone_number VARCHAR(15),
    email VARCHAR(100),
    availability_schedule VARCHAR(255)
);

-- 6. Payments Table Definition
CREATE TABLE Payments (
    payment_id INT PRIMARY KEY,
    member_id INT,
    amount DECIMAL(10, 2),
    payment_date DATE,
    payment_method VARCHAR(50),
    status VARCHAR(10),
    transaction_reference VARCHAR(100),
    FOREIGN KEY (member_id) REFERENCES Members(member_id)
);

-- 7. Personal Training Sessions Table Definition
CREATE TABLE PersonalTrainingSessions (
    session_id INT PRIMARY KEY,
    member_id INT,
    trainer_id INT,
    session_date DATE,
    start_time TIME,
    end_time TIME,
    session_notes VARCHAR(255),
    FOREIGN KEY (member_id) REFERENCES Members(member_id),
    FOREIGN KEY (trainer_id) REFERENCES Trainers(trainer_id)
);

-- 8. Motivational Quotes Table Definition
CREATE TABLE MotivationalQuotes (
    quote_id INT PRIMARY KEY,
    quote_text VARCHAR(255),
    author VARCHAR(50),
    category VARCHAR(50),
    member_id INT,
    date_added DATE,
    FOREIGN KEY (member_id) REFERENCES Members(member_id)
);

-- 9. Admin Users Table Definition
CREATE TABLE AdminUsers (
    admin_id INT PRIMARY KEY,
    username VARCHAR(50),
    password_hash VARCHAR(255),
    email VARCHAR(100),
    role_id INT
);

-- 10. User Roles Table Definition
CREATE TABLE UserRoles (
    role_id INT PRIMARY KEY,
    role_name VARCHAR(50)
);

-- 11. Class Feedback Table Definition (for gathering feedback on classes or trainers)
CREATE TABLE ClassFeedback (
    feedback_id INT PRIMARY KEY,
    class_id INT,
    member_id INT,
    rating INT CHECK (rating BETWEEN 1 AND 5), -- rating from 1 to 5 stars
    comments VARCHAR(255),
    FOREIGN KEY (class_id) REFERENCES Classes(class_id),
    FOREIGN KEY (member_id) REFERENCES Members(member_id)
);

-- 12. Gym Equipment Table Definition (for tracking gym equipment and maintenance)
CREATE TABLE GymEquipment (
    equipment_id INT PRIMARY KEY,
    equipment_name VARCHAR(50),
    maintenance_status VARCHAR(20), -- status such as 'available', 'under maintenance'
    last_maintenance_date DATE
);


