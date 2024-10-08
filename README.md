<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## TODO Application

A simple API-based application for managing to-do lists built with [Laravel 11](https://laravel.com/docs/11.x/), and utilizing Laravel Sanctum for secure authentication.

## Features

- User Registration and Authentication via Laravel Sanctum
- CRUD operations for User
- CRUD operation for ToDos
- User specific ToDo lists
- ToDo Completion (Marking a ToDo item as Completed)

## Installation

1. Clone the repository
2. Run `composer install`
3. Set up the database connection in `.env` file
4. Run `php artisan migrate --seed`
5. Start the server with `php artisan serve`

## Usage

### Authentication

- Register a new User: `POST /api/register`
- Login: `POST /api/login`
- Get current User info: `GET /api/me`
- Logout: `POST /api/logout`

## User Management

- Read all User: `GET /api/users`
- Read User by ID: `GET /api/users/{user}`
- Update User: `PUT /api/users/{user}`
- Change password: `PUT /api/change-password`
- Delete User: `DELETE /api/users/{user}`

## Current User Management

- Get ToDo items: `GET /api/user/todos`
- Get ToDo item by ID: `GET /api/user/todos/{todo}`

### Todo Management

- Create new Todo item `POST /api/todos`
- Read all ToDo item: `GET /api/todos`
- Read Todo item by ID: `GET /api/todos/{todo}`
- Update ToDo item by ID: `PUT /api/todos/{todo}`
- Update ToDo item's status: `PUT /api/todos/{todo}/completed`
- Delete ToDo item: `DELETE api/todos/{todo}`

## Models

### User

- Attributes: `username`, `email`, `password`
- Relationships: `todos`

### Todo

- Attributes: `title`, `description`, `status`
- Relationships: `users`

## Controllers

- `AuthController`: Handles authentication endpoints
- `UserController`: Handles User-related endpoints
- `TodoController`: Handles ToDo-related endpoints
- `TodoUserController`: Handles ToDo-User relationship endpoints

## Security Considerations

- Implement proper authentication and authorization checks using Laravel Sanctum
- Validate input data on both client-side and server-side
- Use HTTPS for all API communications
- Implement rate limiting to prevent abuse

## Testing

Run `php artisan test` to execute the PHPUnit tests.

## Contributing

Contributions are welcome! Feel free to open an issue or submit a pull request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
