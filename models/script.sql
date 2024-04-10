SET GLOBAL max_allowed_packet=16*1024*1024; -- Set max_allowed_packet to 16MB to accept high quality images

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL,
    Role ENUM('Admin', 'User') DEFAULT 'User',
    Verified BOOLEAN DEFAULT FALSE,
    profilePicture LONGBLOB DEFAULT NULL,
    profilePictureFormat VARCHAR(10)
);

CREATE TABLE verification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    verification_code VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE post(
    id INT AUTO_INCREMENT PRIMARY KEY,
    image LONGBLOB,
    imageFormat VARCHAR(10),
    title VARCHAR(30) NOT NULL,
    description TEXT NOT NULL,
    Author INT NOT NULL,
    date DATE,
    FOREIGN KEY (Author) REFERENCES users(id),
    bgColor VARCHAR(255) DEFAULT 'linear-gradient(96.55deg, #00ffff -25.2%, #147efb 55.15%)',
);

CREATE TABLE visitors(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    website VARCHAR(255) NOT NULL,
    ip VARCHAR(255) NOT NULL,
    date DATE,
    referrer VARCHAR(255) DEFAULT 'Direct',
    country VARCHAR(255),
    device ENUM('Computer', 'Phone') DEFAULT 'Computer',
    browser ENUM('Chrome', 'Firefox', 'Safari', 'Opera', 'Edge', 'Other') DEFAULT 'Other',
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE likes (
    user_id INT NOT NULL REFERENCES users(id),
    post_id INT NOT NULL REFERENCES post(id),
    PRIMARY KEY (user_id,post_id)
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(id),
    post_id INT NOT NULL REFERENCES post(id),
    comment TEXT NOT NULL,
    date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE feedbacks(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(id),
    Feedback TEXT NOT NULL,
    Date DATE,
    Hidden BOOLEAN DEFAULT FALSE
);

CREATE TABLE notifications(
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL REFERENCES users(id),
    user_id INT NOT NULL REFERENCES users(id),
    message VARCHAR(255),
    post_id INT NOT NULL REFERENCES post(id),
    date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    seen BOOLEAN DEFAULT FALSE
);
-- 20 Examples 
INSERT INTO visitors (user_id, website, ip, date, referrer, country, device, browswer)
VALUES (1, 'insat.tn', '192.168.1.1', '2024-03-27', 'Facebook', 'Country A', 'Computer', 'Chrome'),
       (1, 'website.tn', '192.168.1.2', '2024-03-26', 'Instagram', 'Country B', 'Phone', 'Firefox'),
       (1, 'insat.tn', '192.168.1.3', '2024-03-25', 'Direct', 'Country A', 'Computer', 'Safari'),
       (1, 'insat.tn', '192.168.1.4', '2024-03-24', 'Google', 'Country B', 'Phone', 'Opera'),
       (1, 'website.tn', '192.168.1.5', '2024-03-23', 'Twitter', 'Country A', 'Computer', 'Edge'),
       (1, 'website.tn', '192.168.1.6', '2024-03-22', 'Direct', 'Country B', 'Phone', 'Other'),
       (1, 'insat.tn', '192.168.1.7', '2024-03-21', 'Facebook', 'Country A', 'Computer', 'Chrome'),
       (1, 'website.tn', '192.168.1.8', '2024-03-20', 'Instagram', 'Country B', 'Phone', 'Firefox'),
       (1, 'insat.tn', '192.168.1.9', '2024-03-19', 'Direct', 'Country A', 'Computer', 'Safari'),
       (1, 'insat.tn', '192.168.1.10', '2024-03-18', 'Google', 'Country B', 'Phone', 'Opera'),
       (1, 'website.tn', '192.168.1.11', '2024-03-17', 'Twitter', 'Country A', 'Computer', 'Edge'),
       (1, 'insat.tn', '192.168.1.12', '2024-03-16', 'Direct', 'Country B', 'Phone', 'Other'),
       (1, 'insat.tn', '192.168.1.13', '2024-03-15', 'Facebook', 'Country A', 'Computer', 'Chrome'),
       (1, 'website.tn', '192.168.1.14', '2024-03-14', 'Instagram', 'Country B', 'Phone', 'Firefox'),
       (1, 'insat.tn', '192.168.1.15', '2024-03-13', 'Direct', 'Country A', 'Computer', 'Safari'),
       (1, 'insat.tn', '192.168.1.16', '2024-03-12', 'Google', 'Country B', 'Phone', 'Opera'),
       (1, 'website.tn', '192.168.1.17', '2024-03-11', 'Twitter', 'Country A', 'Computer', 'Edge'),
       (1, 'website.tn', '192.168.1.18', '2024-03-10', 'Direct', 'Country B', 'Phone', 'Other'),
       (1, 'insat.tn', '192.168.1.19', '2024-03-09', 'Facebook', 'Country A', 'Computer', 'Chrome'),
       (1, 'website.tn', '192.168.1.20', '2024-03-08', 'Instagram', 'Country B', 'Phone', 'Firefox');
