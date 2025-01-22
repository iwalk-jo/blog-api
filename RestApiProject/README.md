# RestApiProject

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

## Project Overview

This is a **RESTful API Project** built using the **Laravel** framework. The application includes:

-   **User authentication** using Laravel Breeze for secure registration, login, and password reset functionality.
-   **CRUD operations** for managing posts.
-   **Database migrations** and **seeders** for smooth setup.
-   **Permissions** for managing user access.

---

## Installation Instructions

### 1. Clone the Repository

First, clone the repository to your local machine:

```bash
git clone https://github.com/your-username/RestApiProject.git
cd RestApiProject
2. Install Laravel
If you’re starting from scratch, you can install Laravel using the following command:

bash
Copy
Edit
composer create-project --prefer-dist laravel/laravel RestApiProject
3. Install Dependencies
Run the following command to install the necessary dependencies:

bash
Copy
Edit
composer install
4. Set Up Environment Configuration
Copy the .env.example file to .env:

bash
Copy
Edit
cp .env.example .env
Update the database credentials in the .env file to match your local database setup:

env
Copy
Edit
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
5. Generate Application Key
Generate a unique key for your application:

bash
Copy
Edit
php artisan key:generate
6. Run Migrations and Seeders
Run the migrations to set up your database schema:

bash
Copy
Edit
php artisan migrate
If you have seeding set up, run the seeder to populate the database with sample data:

bash
Copy
Edit
php artisan db:seed
Authentication Setup (Laravel Breeze)
1. Install Laravel Breeze
Breeze provides simple authentication scaffolding for your application:

bash
Copy
Edit
composer require laravel/breeze --dev
php artisan breeze:install api
npm install && npm run dev  # Optional for frontend scaffolding
php artisan migrate
This will set up routes and controllers for registration, login, logout, and password reset.

Deploying to Heroku
1. Create a Heroku Application
Create a new Heroku application:

bash
Copy
Edit
heroku create
2. Set Up Heroku Database
Provision a PostgreSQL database for your Heroku application:

bash
Copy
Edit
heroku addons:create heroku-postgresql:hobby-dev
3. Push Code to Heroku
Commit your code and push it to Heroku:

bash
Copy
Edit
git add .
git commit -m "Initial commit"
git push heroku main
4. Set Up Environment Variables
Ensure that the APP_KEY and database environment variables are set:

bash
Copy
Edit
heroku config:set APP_KEY=your_application_key
5. Run Migrations on Heroku
Run the migrations to set up your database on Heroku:

bash
Copy
Edit
heroku run php artisan migrate
Known Issues and Resolved Errors
1. "Class 'Faker\Factory' not found" Error
Cause: The fakerphp/faker package was missing in the production environment.

Resolution: Add fakerphp/faker to the require section in composer.json, instead of require-dev, and redeploy the application.

Steps:

Move fakerphp/faker to require in composer.json.
Run composer update --no-dev.
Push changes to Heroku: git push heroku main.
Clear cache and config on Heroku:
bash
Copy
Edit
heroku run php artisan config:clear
heroku run php artisan cache:clear
2. Post Model and Migration Errors
Cause: Post model, migration, and factories were not properly created.

Resolution: Ensure the following commands were run:

bash
Copy
Edit
php artisan make:model Post -m
php artisan make:factory PostFactory
php artisan make:seed PostSeeder
php artisan make:seed UsersSeeder
php artisan make:migration create_personal_access_tokens_table
Additional Notes
Testing the API
Once the application is running locally or on Heroku, you can use tools like Postman or Insomnia to test the API endpoints for:

User registration
Login
CRUD operations for posts
License
This project is open-source and available under the MIT License.
```
