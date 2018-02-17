# PHP-Project  
[![Build Status](https://travis-ci.org/ukiras123/PHP-Project.svg?branch=master)](https://travis-ci.org/ukiras123/PHP-Project/)

**How to setup manually**
- Install MAMP
- Copy this project to MAMP/htdocs folder
- Start the server
- Run schema.sql for database setup
- Change DB credential in app/userlogin/config.php
- http://localhost:8080/

**How to build and run in Docker**
- docker build -f Dockerfile -t myapp .
- docker run -d -p 8080:80 myapp
- http://localhost:8080/

**Use Existing Docker Image**
- docker run -d -p 8080:80 ukiras123/mycompany
- http://localhost:8080/
