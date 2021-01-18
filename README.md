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
Loggin user into a plataform.  
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

### POST /api/polls
Only User Admin can be created a new Poll  
Example: http://localhost:8000/api/polls

Request body:
```json
  {
    "polls": {
        "name": "Test",
        "description": "This is a poll test"
    },
    "questions": [
        {
            "description": "Question Nº1 ?",
            "multiple_option": "0",
            "options": [
                {
                    "description": "Option Nª 1"
                },
                {
                    "description": "Option Nª 2"
                }
            ]
        },
        {
            "description": "Question Nº2?",
            "multiple_option": "0",
            "options": [
                {
                    "description": "Option Nª 3"
                },
                {
                    "description": "Option Nª 4"
                },
                {
                    "description": "Option Nª 5"
                },
                {
                    "description": "Option Nª 6"
                }
            ]
        }
    ]
  }
```


Response body:
```json
  {
    "message": "Poll was created",
    "data": {
        "polls": {
            "name": "Test",
            "description": "This is a poll test"
        },
        "questions": [
            {
                "description": "Question Nº1 ?",
                "multiple_option": "0",
                "options": [
                    {
                        "description": "Option Nª 1"
                    },
                    {
                        "description": "Option Nª 2"
                    }
                ]
            },
            {
                "description": "Question Nº1 ?",
                "multiple_option": "0",
                "options": [
                    {
                        "description": "Option Nª 3"
                    },
                    {
                        "description": "Option Nª 4"
                    },
                    {
                        "description": "Option Nª 5"
                    },
                    {
                        "description": "Option Nª 6"
                    }
                ]
            }
        ]
    }
  } 
```

### GET /api/polls/{id}
Return Poll.  
Only admin user can make the request.  
Example: http://localhost:8000/api/polls/21 

PARAM
 - {id}: required | integer

Response body:
```json
  {
    "id": 21,
    "name": "Test",
    "description": "This is a poll test",
    "enabled": "1",
    "questions": [
        {
            "id": 24,
            "polls_id": 21,
            "description": "Question Nº1 ?",
            "multiple_option": 0,
            "options": [
                {
                    "id": 15,
                    "question_id": 24,
                    "description": "Option Nª 1"
                },
                {
                    "id": 16,
                    "question_id": 24,
                    "description": "Option Nª 2"
                }
            ]
        },
        {
            "id": 25,
            "polls_id": 21,
            "description": "Question Nº1 ?",
            "multiple_option": 0,
            "options": [
                {
                    "id": 17,
                    "question_id": 25,
                    "description": "Option Nª 3"
                },
                {
                    "id": 18,
                    "question_id": 25,
                    "description": "Option Nª 4"
                },
                {
                    "id": 19,
                    "question_id": 25,
                    "description": "Option Nª 5"
                },
                {
                    "id": 20,
                    "question_id": 25,
                    "description": "Option Nª 6"
                }
            ]
        }
    ]
  }
```

### POST /api/answer  
Create new User answer.  
The user can make chose one option.  
Example: http://localhost:8000/api/answer 

Request body:
```json
 {
    "poll_id": "21",
    "answers": [
        {
            "question_id": "24",
            "question_option": [
                {
                    "id": "16"
                }
            ]
        },
        {
            "question_id": "25",
            "question_option": [
                {
                    "id": "18"
                }
            ]
        }
    ]
 }
```


Respond body:
```json
  {
    "message": "The answers were saved successfully"
  }
```


### GET /api/polls/{poll_id}/answer
Return User answers.  
Each user can see their answers.  
Example: http://localhost:8000/api/polls/21/answer

PARAM
 - {poll_id}: required | integer

Respond body:
```json
 [
    {
        "id": 4,
        "question_id": 24,
        "question_option_id": 16,
        "user_id": 4,
        "question": "Question Nº1 ?",
        "option": "Option Nª 2"
    },
    {
        "id": 5,
        "question_id": 25,
        "question_option_id": 18,
        "user_id": 4,
        "question": "Question Nº1 ?",
        "option": "Option Nª 4"
    }
 ]
```

### PUT /api/answer
Update User's answers.  
Only the user who answered the survey has authorization to modify.  
Example: http://localhost:8000/api/answer


Request body:
```json
 [
    {
        "id": 4,
        "question_id": 24,
        "question_option_id": 15
    },
    {
        "id": 5,
        "question_id": 25,
        "question_option_id": 20
    }
  ]
```

Response body:
```json
  {
    "message": "Updated successfull."
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

#copy .env.example to .env
cp .env.example .env

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

# Start localhost  
php artisan serve 

# Another way to start the localhost  "php -S {IPv4}:{PORT}"
# cd public/
php -S localhost:8000

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
