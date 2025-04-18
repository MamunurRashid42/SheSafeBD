//Create Database
CREATE DATABASE shesafe;
USE shesafe;

//users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    security_question VARCHAR(255),
    security_answer VARCHAR(255)
);
//incident_reports Table
CREATE TABLE incident_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NULL,
    incident_type VARCHAR(100),
    datetime DATETIME,
    location VARCHAR(255),
    description TEXT,
    photo VARCHAR(255) NULL,
    submitted_at DATETIME
);

//reports
CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    phone VARCHAR(20),
    location VARCHAR(255),
    incident VARCHAR(100),
    date DATETIME,
    description TEXT,
    photo VARCHAR(255),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
