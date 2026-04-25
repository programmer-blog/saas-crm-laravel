## Progress

- Day 1: PHP OOP, SOLID, Repository Pattern
- Day 2: Composer, PSR-4, Project Structure
- Day 3: Service Container & DI
- Day 4: Request Lifecycle, Routing, Middleware
- Day 5: Laravel Setup (Real Framework)

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

## Summary

"I structure Laravel applications using a layered architecture where controllers handle HTTP requests, services contain business logic, and Eloquent or repositories manage data access. I use dependency injection via the service container to keep the system loosely coupled and maintainable."

php-laravel-backend-mastery

Hands-on learning journey to master modern PHP (8.x) and Laravel.
Covers clean architecture, repository pattern, service layer, DI, and building production-ready backend systems.