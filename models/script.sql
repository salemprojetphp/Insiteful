CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL
);

CREATE TABLE post(
    id INT AUTO_INCREMENT PRIMARY KEY,
    image LONGBLOB,
    imageFormat VARCHAR(10),
    title VARCHAR(30) NOT NULL,
    description TEXT NOT NULL,
    Author INT NOT NULL,
    date DATE,
    FOREIGN KEY (Author) REFERENCES users(id)
);