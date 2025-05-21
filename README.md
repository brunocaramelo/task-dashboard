# TASK DASHBOARD APPLICATION

Quality Certification Seals

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/3933d4c448a84e329a26085c5d59ff47)](https://app.codacy.com/gh/brunocaramelo/task-dashboard/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

[![Codacy Badge](https://app.codacy.com/project/badge/Coverage/3933d4c448a84e329a26085c5d59ff47)](https://app.codacy.com/gh/brunocaramelo/task-dashboard/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_coverage)


## Technical Specifications

This application has the following specifications: 

| Tool | Version |
| --- | --- |
| Docker | 28.1.1 |
| Docker Compose | 2.32.4 |
| Nginx | 1.28.0 |
| PHP | 8.3.9 |
| Postgre | 15.3 |
| Sqlite (Unit Tests) | 3.46.1 |
| Laravel Framework | 10.10 |
| Laravel Reverb | 1.5 |
| Laravel Echo | 2.1.4 |
| Vue 3 | 3.4.0 |
| Prime Vue  | 3.53.1 |
| Tailwindcss  | 3.2.1 |

The application is separated into the following containers

| Service | Image | Motivation
| --- | --- | --- |
| postgres | postgres:15 | Main database |
| php | php-app | Main Application (Web) |
| php | php-cli | CLI Application running Reverb Websocket |
| web (nginx) and Vue 3 | nginx:alpine | Web Server |

## Requirements
    - Docker
    - Docker Daemon (Service)
    - Docker Compose

## Installation procedures
    Procedures for installing the application for local use

1- Download repository 
    - git clone https://github.com/brunocaramelo/task-dashboard.git
       
        we must copy .env.docker-compose.example to .env with the command below:

        - cp .env.docker-compose.example .env
        - cp docker/docker-compose-env/application.env.example docker/docker-compose-env/application.env
        - cp docker/docker-compose-env/ws-application.env.example docker/docker-compose-env/ws-application.env
        - cp docker/docker-compose-env/database.env.example docker/docker-compose-env/database.env

2 - Check that the ports:

    - 443 (nginx) 
    
    - 9000(php-fpm)

    - 5432(postgres) 
    
    - 8182(websocket) 

     are busy.


3 - Enter the application's home directory and run the following commands:
    
    1 - docker-compose up -d;

    ### Description of steps (in case of problems)

    1 - for the images to be stored and executed and upload the instances
        
        (NOTE) - due to composer's delay in bringing up the dependencies, there are 3 alternatives,
        
            1 - RUN sudo docker-compose up; without being a daemon the first time, so that you can check the progress of the installation of dependencies.
            
            2 - Wait 20 minutes or so for the command to be executed, to avoid autoloading for example.
            
            
    2 - for the framework to generate and apply the mapping for the database (SQL), which can be PostGres or SQLITE.
    
    3 - for the framework to apply changes to the database data, in the case of inserting a first user.
    
    4 - generation of a hash key for use by the system as a validation key.
    
    5 - for the framework to run the test suite.
        - API tests  
        - Unit tests
     

## Post Installation

After installation, the access address is:

- https://localhost/login

### Users Access
| Email | Name | Password
| --- | --- | --- |
| admin@test.com | Admin | password |
| coworker@test.com | Coworker | password |
| stakeholder@test.com | Stakeholder | password |

## Tecnical Details

    - Laravel 10

    - Postgre 15

    - Vue 3

    - Redis (Cache and Websocket)

    - Laravel Echo

    - Reverb (Websocket)

    - SOLID

    - Unit Tests

    - Docker and docker-compose