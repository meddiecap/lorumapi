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

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
