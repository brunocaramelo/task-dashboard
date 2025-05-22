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
| websocket-server | php-cli | CLI Application running Reverb Websocket |
| web (nginx) and Vue 3 | nginx:alpine | Web Server |

## Requirements
    - Docker
    - Docker Daemon (Service)
    - Docker Compose

## Installation procedures
    Procedures for installing the application for local use

1- Download repository 
    - git clone https://github.com/brunocaramelo/task-dashboard.git
       
        we must copy env files with commands below:

        - cp .env.docker-compose.example .env
        - cp docker/docker-compose-env/application.env.example docker/docker-compose-env/application.env
        - cp docker/docker-compose-env/ws-application.env.example docker/docker-compose-env/ws-application.env
        - cp docker/docker-compose-env/database.env.example docker/docker-compose-env/database.env

2 - Check that the ports:

    - 80 (nginx) 
    
    - 6380 (redis) 
    
    - 9000(php-fpm)

    - 5432(postgres) 
    
    - 8182(websocket) 

     are busy.


3 - Enter the application's home directory and run the following commands:
    
    1 - docker compose up (to see the logs on stdout);

    ### Description of steps (in case of problems)

    1 - for the images to be stored and executed and upload the instances
        
        (NOTE) - due to composer's delay in bringing up the dependencies, there are 3 alternatives,
        
            1 - RUN sudo docker compose up; without being a daemon the first time, so that you can check the progress of the installation of dependencies.
            
            2 - Wait 20 minutes or so for the command to be executed, to avoid autoloading for example.
            
            
    2 - for the framework to generate and apply the mapping for the database (SQL), which can be PostGres or SQLITE.
    
    3 - for the framework to apply changes to the database data, in the case of inserting a first user.
    
    4 - generation of a hash key for use by the system as a validation key.
    
    5 - for the framework to run the test suite.
        - Feature tests  
        - Unit tests
     

## Post Installation

After installation, the access address is:

- http://localhost/login

### Users Credentials
| E-mail | Name | Password
| --- | --- | --- |
| admin@test.com | Admin | password |
| coworker@test.com | Coworker | password |
| stakeholder@test.com | Stakeholder | password |

## Tecnical Details

    - Laravel 10

    - Postgre 15

    - Vue 3

    - Pest

    - Redis (Cache and Websocket)

    - Laravel Echo (Broadcast Client)

    - Reverb (Websocket)

    - SOLID

    - Unit Tests and Feature Tests

    - Docker and docker-compose


#### Extra

    If you want to run the project locally, just run 

    1 - cp .env.local.example .env
    2 - php artisan reverb:start --debug
    3 - php artisan serve
    4 - npm run dev OR npm run build
    5 - php artisan migrate && php artisan db:seed
    6 - and check out http://localhost:8000
    7 - php artisan test
