# JornkTee-app

## Overview
JornkTee-app is a Laravel-based web application designed for user role management, including **SuperAdmin, Admin, and User** functionalities.

## Features
- **SuperAdmin**
  - View all users
  - Promote Users to Admin
  - Demote Admins to Users
  - Delete users
- **Admin**
  - Manage assigned areas
- **User**
  - Standard user functionality

## Installation
### Prerequisites
Ensure you have the following installed:
- PHP (>= 8.1)
- Composer
- Node.js & npm
- Laravel (latest version)
- MySQL or PostgreSQL

### Setup
1. Clone the repository:
   ```sh
   git clone git@github.com:pummyketak/JornkTee-app.git
   cd JornkTee-app
   ```
2. Install dependencies:
   ```sh
   composer install
   npm install
   ```
3. Copy environment configuration:
   ```sh
   cp .env.example .env
   ```
4. Generate the application key:
   ```sh
   php artisan key:generate
   ```
5. Set up your database in `.env` and migrate tables:
   ```sh
   php artisan migrate --seed
   ```
6. Build frontend assets:
   ```sh
   npm run build
   ```
7. Start the development server:
   ```sh
   php artisan serve
   ```

## Usage
- Access the app at `http://127.0.0.1:8000`
- Login as **SuperAdmin** to manage users.

## Deployment
For production deployment:
```sh
php artisan optimize
php artisan cache:clear
php artisan config:cache
```

## Contributing
Feel free to fork the repository and submit pull requests.

## License
MIT License

