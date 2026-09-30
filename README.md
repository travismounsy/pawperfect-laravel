# PawPerfect Pet Grooming

PawPerfect is a pet grooming management application being rebuilt from an earlier PHP/MySQL project using Laravel. It helps organize grooming services and will grow to support pets, customers, and appointment booking.

This project provides hands-on practice with backend development, relational databases, automated testing, and CI/CD.

## Current Features

- Display grooming services and prices from a database
- Add services through a web form
- Validate service names and prices before saving
- Display validation errors and success messages
- Populate sample services using a database seeder

## Technologies

- PHP 8.2
- Laravel 12
- Blade templates
- Eloquent ORM
- SQLite
- Git and GitHub

## Planned Features

- Edit and delete grooming services
- Customer and pet profiles
- Appointment booking and status updates
- Authentication and role-based access
- Automated feature tests
- GitHub Actions CI workflow

## Local Setup

Requires PHP 8.2 or newer and Composer.

1. Clone the repository:

   git clone https://github.com/travismounsy/pawperfect-laravel.git
   cd pawperfect-laravel

2. Install dependencies:

   composer install

3. Create your local configuration:

   Copy .env.example to .env

4. Generate the application key:

   php artisan key:generate

5. For SQLite, create an empty database/database.sqlite file
   and set DB_CONNECTION=sqlite in .env.

6. Create the tables and populate sample services:

   php artisan migrate
   php artisan db:seed --class=ServiceSeeder

7. Start the development server:

   php artisan serve

Open http://127.0.0.1:8000 in your browser.

## Project Status

In development. Service listing and creation are implemented.
Appointment management, authentication, and CI are planned.
