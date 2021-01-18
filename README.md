## Table of Contents
- [Table of Contents](#table-of-contents)
  - [General Info](#general-info)
  - [Requirements](#requirements)
- [Technologies](#technologies)
- [Installation](#installation)
### General Info
***
This API is for Polls can be answered for authenticated user inm the plataform. We have two types of Users, Admin user, and simple user. The Admin user, can create polls, and view polls by id, and a simp`e user can answers polls and update his answers only.
 
### Requirements
- PHP >= 7.2.5
- Composer 
- Database:  PostgresSql | SQL Server | My SQL 
## Technologies
***
A list of technologies used within the project:
* [Laravel Framework](https://laravel.com/docs/7.x/): Version 7.0 
* [JWT-AUTH](https://jwt-auth.readthedocs.io/en/develop/): Version 1.*
## Installation
***
A little intro about the installation. 
```
$ git clone https://github.com/billoBJ/polls-backend.git
$ cd ../path/to/the/file
$ composer install
$ php artisan key:generate
$ php artisan jwt:secret
```
Side information: To use the application in a special environment use ```lorem ipsum``` to start
