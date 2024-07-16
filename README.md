
# AIRO Documentation.

I have used Latest laravel version (11.9) to implement this project.

Above are the main requirements given to me.
- You can use any technology/ies to complete this code challenge but preferably use PHP and Laravel.
- Develop the backend API method call mentioned in the API Documentation.
- Develop a simple form page that can handle user input, call the API method and then display the results.
- Error handling must be setup in both frontend and backend

As per the requirement I mainly used Laravel and PHP.

I have used basic HTML, CSS and JavaScript to develop the front end.

As per the requirements, I have used JWT for authentication. Laravel provides different packages to do the authentication such as Breeze and Sanctum. Which was very simple. But it didn't align with the requirements. So I have integrated JWT directly.

## Project Setup

### Install the dependancies
Run the following command in your terminal

`composer install`

### Clone the project from the repository

### Environment setup
Copy .env.example and create a new .env file

Following are the additional values that you need to set

`JWT_SECRET=q5ELihkyjudERuTyvDkjrun4EM82zrNKonfiG55E1dqfY7328dWr29xXmmSJkGPS

JWT_ALGO=HS256

FIXED_QUOTATION_RATE=3`

### Run Migration

Run the following command in your terminal

`php artisan migrate`

### Note

I took some decisions while developing the project. 

- Since it does not require frontend development, I have used basic HTML, CSS and Javascript. Instead of using React or Vue Js.
- The expected quotation endpoint is `/quotation`, in order to maintain some standards I have used `/api/quotation`. I could have put api version in this endpoint. But I feel it's not required for this project.