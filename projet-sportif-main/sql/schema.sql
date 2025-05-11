CREATE DATABASE IF NOT EXISTS sport
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;
USE sport;

CREATE TABLE IF NOT EXISTS users (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  pseudo   VARCHAR(50) NOT NULL UNIQUE,
  email    VARCHAR(100) NOT NULL UNIQUE,
  pass     VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS activities (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  user_id   INT NOT NULL,
  sport     VARCHAR(50) NOT NULL,
  distance  FLOAT NOT NULL,
  duration  INT NOT NULL,
  calories  INT NOT NULL,
  date      DATETIME NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);
