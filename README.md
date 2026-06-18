# TASK DASHBOARD APPLICATION

Quality Certification Seals

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/3933d4c448a84e329a26085c5d59ff47)](https://app.codacy.com/gh/brunocaramelo/task-dashboard/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

[![Codacy Badge](https://app.codacy.com/project/badge/Coverage/3933d4c448a84e329a26085c5d59ff47)](https://app.codacy.com/gh/brunocaramelo/task-dashboard/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_coverage)


## Technical Specifications

This application has the following specifications: 

| Tool | Version |
| --- | --- |
| Docker | 29.5.1 |
| Docker Compose | 5.1.4 |
| FRANKENPHP (WEBSERVER) | 8.4.9 |
| PHP | 8.4.6 |
| Postgre | 15.3 |
| Sqlite (Unit Tests) | 3.46.1 |
| Laravel Framework | 12.10 |
| Laravel Reverb | 1.5 |
| Laravel Echo | 2.1.4 |
| Vue 3 | 3.2.0 |
| Prime Vue  | 3.53.1 |
| Tailwindcss  | 3.2.1 |

The application is separated into the following containers

| Service | Image | Motivation
| --- | --- | --- |
| postgres | postgres:15 | Main database |
| php | php-app | Main Application (Web) |
| websocket-server | php-cli | CLI Application running Reverb Websocket |
| webserver and Vue 3 | dunglas/frankenphp:1.1.3-php8.3 | Web Server |

## Requirements
    - Docker
    - Docker Daemon (Service)
    - Docker Compose

## Installation procedures
    Procedures for installing the application for local use

1- Download repository 
    - git clone https://github.com/brunocaramelo/task-dashboard.git
       
        we must copy env files with commands below:

        - cp docker/docker-compose-env/application.env.example docker/docker-compose-env/application.env
        - cp docker/docker-compose-env/ws-application.env.example docker/docker-compose-env/ws-application.env
        - cp docker/docker-compose-env/database.env.example docker/docker-compose-env/database.env
        - cp docker/docker-compose-env/testing.env.example docker/docker-compose-env/testing.env

2 - Enter the application's home directory and run the following commands to install dependencies and build frontend files:
    - docker compose up compiler;

3 - Check that the ports:

    - 80 (webserver) 
    
    - 6380 (redis) 
    
    - 9000(php-fpm)

    - 5432(postgres) 
    
    - 8182(websocket) 

     are busy.


3 - Enter the application's home directory and run the following commands:
    
    1 - docker compose up (to see the logs on stdout);

     

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

    - Laravel 12 (Framework Backend)

    - Postgre 15 (Database)

    - Vue 3 (Framework Frontend)

    - Pest (Test Suite)

    - Redis (Cache and Websocket)

    - Laravel Echo (Broadcast Client)

    - Reverb (Websocket)

    - Hexagonal architecture
    
    - SOLID
    
    - Unit Tests and Feature Tests

    - Docker and docker-compose


### Run Unit Tests

    - docker compose up unit-tests;

