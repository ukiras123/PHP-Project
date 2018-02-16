DROP DATABASE IF EXISTS app;
Create DATABASE app;
USE app;



CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    type VARCHAR(5) NOT NULL,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    companyname VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)