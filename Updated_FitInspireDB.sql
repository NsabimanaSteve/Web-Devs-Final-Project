-- Drop existing database if it exists
DROP DATABASE IF EXISTS FitInspireDB;

-- Create the new database
CREATE DATABASE FitInspireDB;
USE FitInspireDB;

-- 1. Create Images Table
CREATE TABLE Images (
    image_id INT PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(50) NOT NULL, -- e.g., 'trainer', 'class', 'membership', 'banner'
    image_url VARCHAR(255) NOT NULL, -- Path to the image file
    description VARCHAR(255) -- Optional description or alt text
);

-- 2. Create Memberships Table
CREATE TABLE Memberships (
    membership_id INT PRIMARY KEY AUTO_INCREMENT,
    membership_type VARCHAR(50),
    price DECIMAL(10, 2),
    duration INT, -- Duration in months
    description VARCHAR(255),
    image_id INT, -- Foreign key to Images table
    FOREIGN KEY (image_id) REFERENCES Images(image_id)
);

-- 3. Create User Roles Table
CREATE TABLE UserRoles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL
);

-- 4. Create Users Table
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    role_id INT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES UserRoles(role_id)
);

-- 5. Create Trainers Table
CREATE TABLE Trainers (
    trainer_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    specialization VARCHAR(50),
    fun_fact VARCHAR(255),
    favorite_quote TEXT,
    image_id INT, -- Link to Images table
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (image_id) REFERENCES Images(image_id)
);

-- 6. Create Members Table
CREATE TABLE Members (
    member_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    membership_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (membership_id) REFERENCES Memberships(membership_id) ON DELETE SET NULL
);

-- 7. Create Classes Table
CREATE TABLE Classes (
    class_id INT PRIMARY KEY AUTO_INCREMENT,
    class_name VARCHAR(50) NOT NULL,
    trainer_id INT NOT NULL,
    image_id INT, -- Link to Images table
    schedule_time DATETIME NOT NULL,
    max_slots INT NOT NULL,
    available_slots INT NOT NULL,
    FOREIGN KEY (trainer_id) REFERENCES Trainers(trainer_id),
    FOREIGN KEY (image_id) REFERENCES Images(image_id)
);

-- 8. Create Bookings Table
CREATE TABLE Bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    member_id INT NOT NULL,
    class_id INT NOT NULL,
    booking_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (member_id) REFERENCES Members(member_id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES Classes(class_id) ON DELETE CASCADE
);

-- 9. Create Feedback Table
CREATE TABLE Feedback (
    feedback_id INT PRIMARY KEY AUTO_INCREMENT,
    member_id INT NOT NULL,
    feedback_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (member_id) REFERENCES Members(member_id) ON DELETE CASCADE
);

-- 10. Create Blog Posts Table
CREATE TABLE BlogPosts (
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(150) NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    image_id INT, -- Link to Images table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (image_id) REFERENCES Images(image_id)
);

-- 11. Specializations of the trainers
CREATE TABLE Specializations(
    spec_id INT PRIMARY KEY AUTO_INCREMENT,
    spec_name VARCHAR(50) NOT NULL,

);

-- Insert Sample Data --

-- Insert Images for Classes, Trainers, and Other Categories
INSERT INTO Images (category, image_url, description) VALUES
('class', 'images/classes/yoga_class.jpg', 'Yoga Class'),
('class', 'images/classes/kickboxing_class.jpg', 'Kickboxing Class'),
('class', 'images/classes/cardio_class.jpg', 'Cardio Class'),
('trainer', 'images/trainers/blay.jpg', 'Trainer Blay'),
('trainer', 'images/trainers/jane.jpg', 'Trainer Jane'),
('trainer', 'images/trainers/john.jpg', 'Trainer John'),
('banner', 'images/banner.jpg', 'Gym Banner Image');

-- Insert User Roles
INSERT INTO UserRoles (role_name) VALUES
('Member'), ('Trainer'), ('Admin');

-- Insert Users (Trainers, Members, Admin)
INSERT INTO Users (role_id, full_name, email, password) VALUES
(3, 'Admin User', 'admin@fitinspirehub.com', 'hashedpassword'),
(2, 'Blay Trainer', 'blay@fitinspirehub.com', 'hashedpassword'),
(2, 'Jane Doe', 'jane@fitinspirehub.com', 'hashedpassword'),
(2, 'John Smith', 'john@fitinspirehub.com', 'hashedpassword'),
(1, 'Member User', 'member@fitinspirehub.com', 'hashedpassword');

-- Insert Trainers
INSERT INTO Trainers (user_id, specialization, fun_fact, favorite_quote, image_id) VALUES
(2, 'Yoga', 'Loves mountain climbing.', 'Keep pushing your limits.', 4),
(3, 'Kickboxing', 'Enjoys outdoor adventures.', 'Strength comes from struggle.', 5),
(4, 'Cardio', 'Passionate about endurance sports.', 'Sweat is magic.', 6);

-- Insert Memberships
INSERT INTO Memberships (membership_type, price, duration, description, image_id) VALUES
('Basic', 30.00, 1, 'Access to gym facilities only', NULL),
('Standard', 50.00, 1, 'Gym facilities + group classes', NULL),
('Premium', 80.00, 1, 'Gym facilities + group classes + personal trainer sessions', NULL);

-- Insert Members
INSERT INTO Members (user_id, membership_id) VALUES
(5, 1); -- Member with Basic membership

-- Insert Classes
INSERT INTO Classes (class_name, trainer_id, schedule_time, max_slots, available_slots, image_id) VALUES
('Morning Yoga', 1, '2024-12-01 08:00:00', 20, 15, 1),
('Evening Kickboxing', 2, '2024-12-01 18:00:00', 15, 10, 2),
('Afternoon Cardio', 3, '2024-12-01 15:00:00', 25, 20, 3);
