# PHP-Project

**How to setup manually**
- Install MAMP
- Copy this project to MAMP/htdocs folder
- Start the server
- Run schema.sql for database setup
- Change DB credential in app/userlogin/config.php

**How to run in Docker**
- docker build -f Dockerfile -t myapp .
- docker run -d -p 8080:80 myapp

**Use Existing Docker Image**
- docker run -d -p 8080:80 ukiras123/mycompany
