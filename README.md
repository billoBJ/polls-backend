## Table of Contents
- [Table of Contents](#table-of-contents)
- [General Info](#general-info)
- [Requirements](#requirements)
- [Technologies](#technologies)
- [Endpoints](#endpoints)
- [Installation](#installation)
- [Additional Information](#additional-information)
### General Info
***
This API creates Polls that can be answered by authenticated users in the plataform. We have two types of Users: Admin user, and regular user. The Admin user, can create polls, and view polls by id, and the regular user can only answers polls and update his answers
 
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
### Example structure for an Error Response 

Error Response
```json
{
    "message": "Error - Unauthorized",
    "error": "The user must be logged in."
}
```

### POST /api/login
Loggin user into a plataform
Example: http://localhost:8000/api/login

Request body:
```json
  {
    "email": "user1@test.com",
    "password": "test123"
  }
```

Response body:
```json
  {
    "access_token": "TOKEN_GENERETED",
    "token_type": "Bearer",
    "expires_in": 86400
  }
```
For the following endpoints, it is necessary to send the authorization token in the request header
- This ensures that the user is properly authenticated.

```json
  {
    "Authorization": "Bearer TOKEN_GENERATED",
  }
```

### POST /api/logout
Invalidate the user's token.
Example: http://localhost:8000/api/logout

Response body:
```json
  {
    "message": "Successfully logged out"
  } 
```

### Installation
***
Installation for localhost enviroment: 
```
# clone repository
$ git clone https://github.com/billoBJ/polls-backend.git

# go to repository folder
cd ../path/to/the/file

# Install Packages
composer install

# Generate APP_KEy
php artisan key:generate

# Generate JWT secret key
php artisan jwt:secret

# Set Database .env  configuration
DB_CONNECTION=CONECTION_DRIVER
DB_HOST=IP_HOST
DB_PORT=PORT
DB_DATABASE=YOUR_DATABSE_NAME
DB_USERNAME=YOUR_DATABASE_USER
DB_PASSWORD=YOUR_DATABASE_PASSWORD

# Migrate DB tables
php artisan migrate

# Run Seeds, this generate Admin User and Users  *see table user in Additional Information
php artisan db:seed --class=UsersTableSeeder

```
### Additional Information
***
Users generated with seeders: 

| User | Password | Type User
| ------------- | ------------- | ------------- |
| admin@test.com  | test123  | Admin |
| user1@test.com  | test123  | Simple User |
| user2@test.com  | test123  | Simple User |
| user3@test.com  | test123  | Simple User |
