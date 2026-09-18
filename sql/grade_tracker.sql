CREATE DATABASE grade_tracker;
USE grade_tracker;

CREATE TABLE  users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(64),
    password_hash VARCHAR(64)
    );
    
CREATE TABLE roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(64)
    );
    
CREATE TABLE permissions (
    permission_id INT PRIMARY KEY AUTO_INCREMENT,
    action_name VARCHAR(64)
    );
    
CREATE TABLE role_permissions(
    role_id INT,
    permission_id INT,
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
	);
    
CREATE TABLE user_roles(
    user_id INT,
    role_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
    );

