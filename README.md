## SaaS CRM Backend (Laravel)

## Overview

This project is a multi-tenant CRM backend built using Laravel.
It demonstrates production-level backend architecture including authentication, authorization, and scalable API design.

---

## Features

* User Authentication (Token-based using Laravel Sanctum)
* Multi-tenant architecture (Organizations)
* Customer Management (CRUD)
* Search, filtering, and pagination
* Role-based access control (admin/user)
* Clean architecture (Controller → Service → Model)
* API Resources for structured responses
* Form Requests for validation

---

## Tech Stack

* PHP 8+
* Laravel
* MySQL
* Laravel Sanctum (API Authentication)

---

## Architecture

Route
→ Controller (handles HTTP)
→ Form Request (validation)
→ Service (business logic)
→ Model (database)
→ API Resource (response)

---

## Authentication (Sanctum)

Laravel Sanctum is used for token-based authentication.

Flow:

1. User logs in
2. Server generates API token
3. Client sends token in headers:
   Authorization: Bearer {token}
4. Protected routes use `auth:sanctum` middleware

---

## Multi-Tenancy

* Each user belongs to an organization
* All data is scoped using `organization_id`
* Ensures data isolation between tenants

---

## API Endpoints

### Auth

POST /api/register
POST /api/login
POST /api/logout
GET /api/me

---

### Customers

GET /api/customers
POST /api/customers
PUT /api/customers/{id}
DELETE /api/customers/{id}

---

## Local Setup

### 1. Clone repo

git clone <your-repo-url>
cd project

---

### 2. Install dependencies

composer install

---

### 3. Setup environment

cp .env.example .env
php artisan key:generate

---

### 4. Configure database

Update `.env` with DB credentials

---

### 5. Run migrations

php artisan migrate

---

### 6. Start server

php artisan serve

---

## Testing (Postman)

### Register

POST /api/register

{
"name": "test",
"email": "[test@test.com](mailto:test@test.com)",
"password": "123456",
"organization_name": "Test Corp"
}

---

### Login

POST /api/login

Response returns token

---

### Use token

Add header:

Authorization: Bearer {your_token}

---

### Test protected route

GET /api/customers

---

## Notes

* Passwords are hashed using Laravel Hash
* Sensitive fields are hidden from API responses
* Validation handled via Form Requests
* Business logic separated using Service layer

---

## Future Improvements

* Role & permission system (advanced)
* Invitations / team management
* Dashboard analytics
* Deployment with Docker
* CI/CD pipeline
  
---

- PHP OOP, SOLID, Repository Pattern
- Composer, PSR-4, Project Structure
- Service Container & DI
- Request Lifecycle, Routing, Middleware
- Laravel based saas crm

# Laravel Core Concepts Reference

## 1. Request Lifecycle

When a request hits a Laravel application:

public/index.php → bootstrap/app.php → Service Container → Middleware → Route → Controller → Service → Database → Response

Explanation:
Laravel processes every request through a pipeline. Middleware handles cross-cutting concerns before the request reaches the controller. The controller delegates business logic to services and returns a response.

---

## 2. Service Container

Definition:
The service container is responsible for resolving and injecting dependencies automatically.

Example:
class UserController {
public function __construct(AuthService $authService) {}
}

Explanation:
Laravel automatically creates the AuthService instance and injects it. No manual object creation is needed.

Interview Answer:
Laravel uses a service container to resolve dependencies via constructor injection. It allows binding interfaces to implementations and promotes loose coupling.

---

## 3. Dependency Injection (DI)

Definition:
Passing dependencies instead of creating them inside a class.

Bad:
new AuthService();

Good:
public function __construct(AuthService $authService)

Why:

* Improves testability
* Reduces coupling
* Works with Laravel container

---

## 4. Routing

Definition:
Mapping HTTP requests to controller actions.

Example:
Route::get('/users', [UserController::class, 'index']);

Explanation:
Routing connects URLs to application logic.

---

## 5. Middleware

Definition:
A layer that runs before or after a request.

Use Cases:

* Authentication
* Logging
* Validation
* Rate limiting

Interview Answer:
Middleware handles request filtering and cross-cutting concerns before reaching controllers.

---

## 6. Controllers

Rule:
Controllers should be thin.

Bad:
Putting business logic inside controller

Good:
Delegating to service layer

Example:
return $this->authService->login($request);

---

## 7. Service Layer

Definition:
Contains business logic.

Example:
class AuthService {
public function login(...) {}
}

Why:

* Keeps controllers clean
* Makes logic reusable
* Improves testing

---

## 8. Repository Pattern

Definition:
Abstraction over data access.

Reality in Laravel:
Eloquent already provides ORM, so repositories are optional but useful in complex systems.

Interview Answer:
Used to decouple business logic from data access and improve flexibility.

---

## 9. Eloquent ORM

Definition:
Laravel’s ORM for database interaction.

Example:
User::where('email', $email)->first();

Features:

* Relationships
* Query builder
* Scopes

---

## 10. Validation

Example:
$request->validate([
'email' => 'required|email'
]);

Purpose:
Ensures data integrity before business logic executes.

---

## 11. Authentication (Sanctum)

Used for:

* APIs
* SPA authentication

Feature:
Token-based authentication system.

---

## 12. Queues

Definition:
Background job processing.

Use Cases:

* Sending emails
* Notifications
* Heavy tasks

Benefit:
Improves performance and user experience.

---

## 13. Caching

Example:
Cache::remember('users', 60, fn() => User::all());

Purpose:
Reduce database load and improve speed.

---

## 14. API Resources

Definition:
Transform models into API responses.

Example:
return new UserResource($user);

Purpose:

* Hide sensitive fields (like password)
* Standardize API output

---

## 15. Architecture Summary

Controller → Service → Repository → Database

Controller:
Handles HTTP

Service:
Business logic

Repository / Eloquent:
Data access

---

## How do you structure authentication in Laravel?

I separate concerns by keeping controllers thin and placing business logic in a service layer. Authentication logic like hashing and validation is handled in the service, while Eloquent manages persistence. Sensitive fields like passwords are hidden using model properties.

---

## Token-based authentication using Laravel Sanctum

I implemented token-based authentication using Laravel Sanctum. Users receive API tokens upon login, which are used to access protected routes. I structured the logic using a service layer and applied validation to ensure secure and clean input handling.

---
Implemented a customer module scoped by organization_id to ensure multi-tenant data isolation. Business logic is handled in a service layer and controllers remain thin.

---

Built a multi-tenant CRM system with full CRUD operations, pagination, and filtering. Ensured data isolation using organization scoping and used API Resources for clean responses. Also implemented basic role-based access control.

---

Follow clean architecture in Laravel using Form Requests for validation, services for business logic, and Eloquent for data access. I also implement proper error handling, logging, and consistent API responses for production readiness.

---

## Summary

"I structure Laravel applications using a layered architecture where controllers handle HTTP requests, services contain business logic, and Eloquent or repositories manage data access. I use dependency injection via the service container to keep the system loosely coupled and maintainable."
