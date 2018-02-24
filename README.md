# PHP-Project  

**How to setup manually** [Setup App server and DB locally]
- Install MAMP
- Copy this project to MAMP/htdocs folder
- Start the server on MAMP
- Change DB credential in app/utilities/config.php
- Change DB credential in app/utilities/credential.php
- Run database/schema.sql for database setup
- Hit: http://localhost:8080/ [Or any port thats configured]

**How to build and run in Docker** [Note: With Docker, DB points to AWS serve mySql and not the local. Get the credential from the config.php file]
- Pre-req - Docker installed on the machine
- docker build -f Dockerfile -t myapp .
- docker run -d -p 8080:80 myapp
- http://localhost:8080/

**Use Existing Docker Image** [Note: DB points to AWS server mySql]
- Pre-req - Docker installed on the machine
- docker run -d -p 8080:80 ukiras123/mycompany
- http://localhost:8080/

**http://ec2-13-57-248-248.us-west-1.compute.amazonaws.com/**
