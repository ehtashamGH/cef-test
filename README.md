## Instructions

Open your terminal or command prompt to run these commands:

- `git clone https://github.com/ehtashamGH/cef-test.git` 
  // Clone project

- `cp .env.example .env` 
  // Creating .env file which contains configuration settings for laravel application

- Create a new database and update the .env file with the database connection information. 
  Example variables for local environment:
  APP_NAME=cef-test //optional
  DB_DATABASE=cef-test //your database name 

- `npm install`
  // Installing node package manager

- `npm run build` and then `npm run dev` 
  //Run both commands to build and compiling assets

- `composer install` 
  // Installing composer dependencies

- `php artisan key:generate`
  // The .env file requires an application key

- `php artisan storage:link`
  // Creating storage link inside public directory

- `php artisan migrate` 
  // Creating database tables

- `php artisan db:seed`
  // Seeding initial data

- `php artisan serve`
   // Finally, this command will start a local development server, and you can access the application in your web browser at `http://localhost:8000` or `http://127.0.0.1:8000`.