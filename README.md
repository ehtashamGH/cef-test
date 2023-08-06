## Instructions

Open your terminal or command prompt to run these commands:

- `git clone https://github.com/ehtashamGH/cef-test.git` 
  //Clone project

- `composer install` 
  //Installing composer dependencies

- `cp .env.example .env` 
  //.env file contains configuration settings for your laravel application:

- `php artisan key:generate`
  //The .env file requires an application key

- Create a new database and update the .env file with the database connection information. 
  Example variables for local environment:
  APP_NAME=cef-test //optional
  DB_DATABASE=cef-test //your database name 


- `php artisan migrate` 
  //Creating database tables

- `php artisan db:seed`
  // Seeding initial data

- `php artisan serve`
   Finally, this command will start a local development server, and you can access the application in your web browser at `http://localhost:8000` or `http://127.0.0.1:8000`.