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
    date DATE DEFAULT CURRENT_TIMESTAMP,
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


--10 posts insertion
INSERT INTO post (title, description, Author) VALUES 
('Introduction to HTML5', 'HTML5 is the latest version of Hypertext Markup Language, the code that describes web pages. It provides new features and improvements over previous versions, making it easier to create modern and interactive websites.', 1),
('CSS3 Styling Techniques', 'CSS3 introduces a wide range of styling techniques for web developers, including advanced selectors, transitions, and animations. By leveraging these features, developers can create visually appealing and responsive web designs.', 1),
('JavaScript Fundamentals', 'JavaScript is a versatile programming language commonly used in web development to add interactivity and dynamic behavior to websites. This post covers the fundamentals of JavaScript, including variables, functions, and control structures.', 1),
('Responsive Web Design Principles', 'Responsive web design is an approach to designing websites that automatically adapt to various screen sizes and devices. This post explores the principles of responsive design and best practices for creating mobile-friendly websites.', 1),
('Backend Development with Node.js', 'Node.js is a popular runtime environment for server-side JavaScript development. This post explains how to use Node.js to build backend applications, handle HTTP requests, and interact with databases.', 1),
('Introduction to React.js', 'React.js is a JavaScript library for building user interfaces, developed by Facebook. This post provides an introduction to React.js, including its component-based architecture and virtual DOM.', 1),
('Building RESTful APIs with Express', 'Express is a minimalist web framework for Node.js that simplifies the process of building web applications and APIs. This post demonstrates how to create RESTful APIs with Express, handle routes, and perform CRUD operations.', 1),
('Database Design and SQL Basics', 'Understanding database design and SQL basics is essential for web developers working with relational databases. This post covers the fundamentals of database design, normalization, and SQL queries.', 1),
('Authentication and Authorization in Web Applications', 'Authentication and authorization are crucial aspects of web application security. This post explores different authentication methods, such as JWT and OAuth, and techniques for implementing user authentication and authorization.', 1),
('Deploying Web Applications to the Cloud', 'Cloud computing offers scalable and cost-effective solutions for deploying web applications. This post discusses different cloud platforms, deployment strategies, and tools for managing web application deployments.', 1);


--posts
INSERT INTO post(title, description, Author, date, bgColor) VALUES
('The Evolution of Web Development',"Web development has evolved significantly since its inception, from static HTML pages to dynamic, AI-powered interfaces. In this article, we'll briefly explore the key milestones in this evolution and glimpse into future trends shaping the industry.
<br>
<br><b>The Birth of the Web:</b>
<br>The World Wide Web was invented by Sir Tim Berners-Lee in the late 1980s, giving rise to static HTML pages with basic text and image embedding.
<br>
<br><b>The Rise of Dynamic Content:</b>
<br>In the mid-1990s, technologies like JavaScript, CSS, and server-side scripting languages enabled the creation of dynamic, interactive websites.
<br>
<br><b>The Web 2.0 Revolution:</b>
<br>The early 2000s saw the emergence of Web 2.0, marked by user-generated content platforms and the adoption of AJAX for seamless user experiences.
<br>
<br><b>Mobile Optimization and Responsive Design:</b>
<br>With the rise of smartphones, responsive web design became crucial, ensuring a consistent user experience across all devices.
<br>
<br><b>The Era of Single-Page Applications (SPAs):</b>
<br>In recent years, there's been a shift towards SPAs for faster load times and smoother transitions, with frameworks like React and Angular leading the way.
<br>
<br><b>The Future of Web Development:</b>
<br>Emerging technologies like AI, AR/VR, and PWAs are poised to reshape web development, offering immersive experiences and enhanced functionality.",1,2024-04-10,'linear-gradient(96.55deg,#00ffff -25.2%, #147efb 55.15%)'),
('Exploring the Evolution of Responsive Web Design',"Responsive web design has become a cornerstone of modern web development, allowing websites to adapt seamlessly to various screen sizes and devices. In this article, we'll delve into the evolution of responsive web design, from its inception to its current state, and explore its impact on user experience and the web development landscape.
<br>
<br><b>The Birth of Responsive Web Design:</b>
<br>Responsive web design emerged as a response to the proliferation of mobile devices and the need for websites to provide consistent user experiences across different screen sizes. In 2010, Ethan Marcotte coined the term "responsive web design" in his seminal article, advocating for a flexible, grid-based layout approach that could adapt to the viewport size of any device.
<br>
<br><b>Key Principles of Responsive Web Design:</b>
<br>Responsive web design is built on several key principles:
<br>
<br>Fluid Grids: Designing layouts using relative units like percentages rather than fixed pixels to create flexible grid systems that adapt to different screen sizes.
<br>Flexible Images: Using CSS techniques like max-width: 100% to ensure that images scale proportionally within their parent containers, preventing distortion or overflow.
<br>Media Queries: Applying CSS media queries to target specific viewport sizes and adjust styles accordingly, allowing for tailored layouts and optimized user experiences across devices.
<br><b>The Evolution of Responsive Web Design:</b>
<br>Since its inception, responsive web design has evolved in response to advancements in web technologies and changes in user behavior:
<br>
<br>-Mobile-First Approach: With the shift towards mobile usage surpassing desktop, many designers and developers have adopted a mobile-first approach, prioritizing the design and optimization of websites for smaller screens before scaling up to larger devices.
<br>Frameworks and Libraries: The rise of front-end frameworks like ---Bootstrap, Foundation, and Materialize has made it easier for developers to implement responsive design principles, providing pre-built components and responsive grid systems.
<br>-Device Agnostic Design: As the diversity of devices continues to expand, designers are moving towards a device-agnostic approach, focusing on creating adaptable layouts and experiences that work seamlessly across all screen sizes and device types.
<br><b>The Impact of Responsive Web Design:</b>
<br>Responsive web design has had a profound impact on user experience and the web development landscape:
<br>
<br>-Improved Accessibility: Responsive websites are accessible to a broader audience, regardless of the device they're using, enhancing usability and inclusivity.
<br>-Enhanced SEO: Google's mobile-first indexing prioritizes responsive websites in search rankings, leading to better visibility and traffic for sites that provide optimized experiences across devices.
<br>-Streamlined Development: Responsive web design streamlines the development process by eliminating the need for separate mobile and desktop versions of a website, reducing maintenance overhead and development time.
<br><b>Future Trends in Responsive Web Design:</b>
<br>As technology continues to evolve, several trends are shaping the future of responsive web design:
<br>
<br>-Responsive Typography: With variable fonts and advanced typographic techniques, designers can create more dynamic and responsive typography that adjusts to different screen sizes and reading environments.
<br>-Modular Design Systems: Modular design systems promote consistency and scalability by breaking interfaces down into reusable components that can adapt and evolve independently, fostering a more flexible and efficient design process.
<br>-Inclusive Design Practices: Inclusive design principles ensure that websites are accessible to all users, regardless of their abilities or assistive technologies, emphasizing the importance of accessibility in responsive web design.
<br>",1,2024-04-09,'linear-gradient(96.55deg, #ffffff -25.2%, #1f2398 55.15%)'),
('The Role of JavaScript Frameworks in Modern Web Development',"JavaScript frameworks have revolutionized the way web applications are built, offering developers powerful tools and libraries to streamline development and enhance user experiences. In this article, we'll explore the role of JavaScript frameworks in modern web development, discussing their benefits, popular options, and future trends shaping the industry.
<br>
<br><b>The Importance of JavaScript Frameworks:</b>
<br>JavaScript frameworks play a crucial role in modern web development by providing developers with pre-written code libraries and tools to simplify common tasks and accelerate development. These frameworks abstract away complex functionalities, allowing developers to focus on building features and solving business problems rather than reinventing the wheel.
<br>
<br><b>Benefits of Using JavaScript Frameworks:</b>
<br>There are several benefits to using JavaScript frameworks in web development:
<br>
<br>-Productivity: Frameworks like React, Angular, and Vue.js offer component-based architectures and declarative syntax, enabling developers to write less code and accomplish more in less time.
<br>-Performance: JavaScript frameworks are optimized for performance, with features like virtual DOM (React) and efficient data binding (Angular) that minimize re-renders and enhance application responsiveness.
<br>-Community Support: Popular JavaScript frameworks have large and active communities of developers, providing resources, tutorials, and third-party libraries to support developers in their projects.
<br>-Scalability: JavaScript frameworks are designed to scale with the complexity of web applications, making them suitable for building everything from small, single-page apps to large-scale enterprise solutions.
<br>
<br><b>Popular JavaScript Frameworks:</b>
<br>Several JavaScript frameworks have gained widespread adoption in the web development community:
<br>
<br>-React: Developed by Facebook, React is a declarative, component-based library for building user interfaces. It's known for its simplicity, performance, and ecosystem of third-party libraries (e.g., Redux, React Router) that enhance its capabilities.
<br>-Angular: Developed by Google, Angular is a comprehensive framework for building dynamic web applications. It provides features like two-way data binding, dependency injection, and modular architecture, making it suitable for large-scale projects.
<br>-Vue.js: Vue.js is a progressive JavaScript framework that focuses on simplicity and flexibility. It's easy to learn and integrate with existing projects, making it an excellent choice for developers of all skill levels.
<br>
<br><b>Future Trends in JavaScript Frameworks:</b>
<br>As web development continues to evolve, several trends are shaping the future of JavaScript frameworks:
<br>
<br>-Server-Side Rendering (SSR): JavaScript frameworks are increasingly adopting server-side rendering techniques to improve initial load times and SEO performance, providing better user experiences and search engine visibility.
<br>Static Site Generators (SSG): Static site generators like Gatsby and Next.js are gaining popularity for building fast, scalable websites and web applications, leveraging JavaScript frameworks for dynamic content generation and client-side interactivity.
<br>-Web Components: Web components are a set of web platform APIs that allow for the creation of reusable custom elements in web pages and applications. JavaScript frameworks are embracing web components to promote interoperability and code reuse across different frameworks and libraries.",1,2024-04-08,'linear-gradient(96.55deg, #00ffff -25.2%, #147efb 55.15%)'),
('Unlocking the Power of APIs in Web Development',"APIs (Application Programming Interfaces) have become essential components of modern web development, enabling seamless integration of data and services across different platforms and applications. In this article, we'll explore the significance of APIs in web development, their diverse applications, and the impact they have on enhancing functionality and user experience.
<br>
<br><b>The Role of APIs in Web Development:</b>
<br>APIs serve as intermediaries that allow different software applications to communicate and interact with each other. In web development, APIs play a crucial role in facilitating data exchange and functionality between various web services, platforms, and devices. They enable developers to access and utilize external resources, such as databases, third-party services, and cloud infrastructure, to enhance the capabilities of their web applications.
<br>
<br><b>Applications of APIs in Web Development:</b>
<br>APIs are utilized in various aspects of web development, including:
<br>
<br>Data Retrieval and Integration: APIs allow developers to retrieve data from external sources, such as social media platforms, weather services, and financial databases, and integrate it into their web applications in real-time.
<br>Third-Party Services Integration: APIs enable developers to integrate third-party services and tools, such as payment gateways, mapping services, and authentication providers, to add additional functionality to their web applications.
<br>Content Management: APIs provided by content management systems (CMS) like WordPress, Drupal, and Joomla allow developers to create custom interfaces and workflows for managing content on their websites.
<br>Mobile App Development: APIs play a crucial role in mobile app development by enabling communication between mobile apps and backend servers, facilitating data synchronization, user authentication, and push notifications.
<br>Automation and Workflow Integration: APIs are used to automate repetitive tasks and integrate different software systems and workflows, improving efficiency and productivity in web development processes.
<br><b>The Impact of APIs on Web Development:</b>
<br>APIs have revolutionized web development by:
<br>
<br>Enhancing Functionality: APIs enable developers to leverage the functionality of external services and platforms, enriching the capabilities of their web applications and providing users with richer and more interactive experiences.
<br>Improving Interoperability: APIs promote interoperability by allowing different software systems and applications to communicate and share data seamlessly, enabling greater integration and collaboration across platforms.
<br>Accelerating Development: APIs accelerate the development process by providing pre-built functionalities and services that developers can easily integrate into their applications, reducing development time and effort.
<br>Fostering Innovation: APIs foster innovation by enabling developers to experiment with new ideas and technologies, rapidly prototype and iterate on their projects, and create novel and inventive solutions to complex problems.
<br><b>Future Trends in API Development:</b>
<br>As technology continues to evolve, several trends are shaping the future of API development, including:
<br>
<br>GraphQL: GraphQL, a query language for APIs developed by Facebook, is gaining popularity for its flexibility and efficiency in fetching data, offering a more intuitive and streamlined approach to API development.
<br>Serverless Architecture: Serverless architecture, which allows developers to build and deploy applications without managing servers, is becoming increasingly popular for API development, offering scalability, cost-effectiveness, and reduced operational overhead.
<br>AI-Powered APIs: AI-powered APIs, which leverage machine learning and natural language processing capabilities, are emerging to provide advanced functionalities such as sentiment analysis, language translation, and image recognition, enabling developers to create more intelligent and context-aware applications.",1,2024-04-04,'linear-gradient(96.55deg, #e8e8e8 -25.2%, #fb8f13 55.15%)'),
("Demystifying Web Development: A Beginner's Guide","<b>Front-End Development:</b>
<br>Front-end development focuses on the user interface and experience of a website, involving the use of languages such as HTML, CSS, and JavaScript. HTML provides the structure of a web page, defining its elements and content. CSS, or Cascading Style Sheets, is responsible for styling the layout and appearance of these elements, including aspects like colors, fonts, and spacing. JavaScript adds interactivity and dynamic behavior to web pages, allowing for features like animations, form validation, and user input handling. Front-end developers need to have a keen eye for design and usability, as well as proficiency in these languages and their associated frameworks and libraries like React, Angular, or Vue.js.
<br>
<br><b>Back-End Development:</b>
<br>Back-end development involves server-side programming and database management to handle data processing, storage, and retrieval. Popular back-end languages and frameworks include Python (Django, Flask), JavaScript (Node.js), Ruby (Ruby on Rails), and PHP (Laravel). These technologies enable developers to create dynamic web applications that can handle user authentication, data manipulation, and server-side logic. Back-end developers need to understand concepts like HTTP protocols, databases (SQL and NoSQL), and server architecture to build scalable and secure applications.
<br>
<br><b>Full-Stack Development:</b>
<br>Full-stack development combines both front-end and back-end skills, allowing developers to work on all aspects of a web application. Full-stack developers are proficient in both client-side and server-side technologies, enabling them to build end-to-end solutions and tackle a wide range of development tasks. They need to have a comprehensive understanding of web development concepts and tools, as well as the ability to seamlessly integrate front-end and back-end components to create cohesive and functional applications.
<br>
<br><b>Essential Tools and Resources:</b>
<br>As a beginner in web development, it's essential to familiarize yourself with the tools and resources available to you. Text editors or integrated development environments (IDEs) like Visual Studio Code, Sublime Text, or Atom are commonly used for writing code. Version control systems like Git and code hosting platforms like GitHub provide collaboration and code management capabilities, allowing developers to work on projects collaboratively and track changes effectively.
<br>
<br>Online learning platforms such as Codecademy, freeCodeCamp, and Udemy offer comprehensive courses and tutorials covering various aspects of web development. These platforms provide structured learning paths, hands-on exercises, and interactive projects to help beginners build practical skills and knowledge. Additionally, community forums like Stack Overflow and developer communities on Reddit provide invaluable support and resources for troubleshooting issues, sharing knowledge, and connecting with other developers.",1,2024-04-03,'linear-gradient(96.55deg, #00ffff -25.2%, #6413fb 55.15%)');

--users
INSERT INTO users(Email, Password, Username, Role, Verified) VALUES
('salmasghaier74@gmail.com','$2y$10$R2IgWzU8HcVUYlYRFTyQme1jmDAb7bSmDIILj8qoNtTuhnB7irBvK','Salma Sghaier','Admin',1),
