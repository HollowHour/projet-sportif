CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pseudo VARCHAR(50),
  email VARCHAR(100),
  pass VARCHAR(255)
);

CREATE TABLE activities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  sport VARCHAR(50),
  distance FLOAT,
  duration INT,
  calories INT,
  date DATETIME
);