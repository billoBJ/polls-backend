## Table of Contents
- [Table of Contents](#table-of-contents)
  - [General Info](#general-info)
  - [Requirements](#requirements)
- [Technologies](#technologies)
- [Endpoints](#endpoints)
- [Installation](#installation)
### General Info
***
This API is for Polls can be answered for authenticated user in the plataform. We have two types of Users, Admin user, and simple user. The Admin user, can create polls, and view polls by id, and a simp`e user can answers polls and update his answers only.
 
### Requirements
- PHP >= 7.2.5
- Composer 
- Database:  PostgresSql | SQL Server | My SQL 
## Technologies
***
A list of technologies used within the project:
* [Laravel Framework](https://laravel.com/docs/7.x/): Version 7.0 
* [JWT-AUTH](https://jwt-auth.readthedocs.io/en/develop/): Version 1.*

## Endpoints
***
## Installation
***
Installation for localhost enviroment: 
```
# clone repository
$ git clone https://github.com/billoBJ/polls-backend.git
# go to repository foulder
$ cd ../path/to/the/file
# Install Packages
$ composer install
# Generate APP_KEy
$ php artisan key:generate
# Generate JWT secret key
$ php artisan jwt:secret
# Migrate DB tables
$ php artisan migrate
# Run Seeds, this generate Admin User and Users 
$ php artisan db:seed --class=UsersTableSeeder
```
