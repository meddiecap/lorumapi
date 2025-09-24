<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Lorem Ipsum API

A RESTful API that provides dummy data for movies, directors, and genres. This API is designed to help developers test their applications with realistic data.

## Getting Started with DDEV

This project uses [DDEV](https://ddev.readthedocs.io/) for local development. DDEV provides a consistent development environment using Docker containers.

### Prerequisites

- [Docker](https://www.docker.com/products/docker-desktop)
- [DDEV](https://ddev.readthedocs.io/en/stable/users/install/)

### Setup Instructions

1. Clone this repository
2. Navigate to the project directory
3. Start DDEV:
   ```
   ddev start
   ```
4. Install dependencies:
   ```
   ddev composer install
   ddev npm install
   ```
5. Copy the environment file:
   ```
   ddev exec cp .env.example .env
   ```
6. Generate application key:
   ```
   ddev exec php artisan key:generate
   ```
7. Run migrations:
   ```
   ddev exec php artisan migrate
   ```
8. Seed the database:
   ```
   ddev exec php artisan db:seed
   ```

### Accessing the Application

- Web: https://lorumapi.ddev.site
- API: https://lorumapi.ddev.site/api

### Vite Assets

This project uses Laravel Vite for asset compilation. When running with DDEV, Vite is automatically started and the assets are served from the correct URL.

The project is configured to use HTTPS for all assets, including Vite assets, to avoid CORS issues. The Vite server is exposed on port 5174 for HTTPS access, and the HMR (Hot Module Replacement) is configured to use the DDEV hostname instead of localhost.
