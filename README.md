## Restaurant Application

A modern restaurant management system built with Laravel.

## Summary

This repository implements a basic restaurant web application with user and admin areas. Main capabilities include menu/food management, cart & checkout, PayPal payment flow scaffolding, bookings, reviews, and a simple admin panel for managing foods, orders and bookings.

## Quick Start (Windows / PowerShell)

Open PowerShell and run these commands from the project root (`c:\wamp64\www\RestaurantApp`):

```powershell
# 1) Install PHP dependencies
composer install

# 2) Install JS dependencies
npm install

# 3) Copy env and set app key
copy .env.example .env
php artisan key:generate

# 4) Configure your DB in .env, then run migrations
php artisan migrate

# 5) Build assets (dev)
npm run dev

# 6) Serve app
php artisan serve
```

If Git commit identity is not set locally, configure it before committing:

```powershell
git config --global user.name "Your Name"
git config --global user.email "you@example.com"
```

## Features (detailed)

- Authentication & Authorization
	- Web user registration, login, password reset and email verification (via Laravel auth controllers).
	- Admin authentication using a separate admin guard and dedicated admin login.

- Public pages
	- Home, About, Services, Contact pages and navigation.

- Food & Menu
	- `Food` model with image upload, description, price and `category` (breakfast, launch, dinner).
	- Food details page with 'Add to cart' functionality.

- Cart & Checkout
	- `Cart` model to store selected items per-user.
	- Session-based price handling for checkout flow and `Checkout` model persistence.
	- PayPal payment view endpoints (`payWithPaypal`, `success`) — integration scaffold.

- Orders
	- Users: view their own `Checkout` orders.
	- Admins: view, edit and delete orders in admin panel.

- Bookings (Reservations)
	- Users can book tables; `Booking` uses Carbon for date validation (future-only bookings).
	- Admin panel lists all bookings.

- Reviews
	- Users can submit short reviews stored via `Review` model.

- Admin panel
	- Dashboard with counts for foods, orders, bookings and admins.
	- Food management (create with image upload, list, delete with image file removal).
	- Admin user creation and listing.

- Models included
	- `App\Models\Food\Food`, `Cart`, `Checkout`, `Booking`, `Review`
	- `App\Models\User` and `App\Models\Admin\Admin` (admin users)

## Routes (high-level)

- Public routes: `home`, `about`, `service`, `contact`
- Food routes (prefix `foods`):
	- `/foods/menu` — list categories
	- `/foods/food-details/{id}` — view and add to cart
	- `/foods/cart` — view cart
	- `/foods/checkout` — checkout form
	- `/foods/pay`, `/foods/success` — payment flow views
	- `/foods/booking` — booking endpoint
- User routes (prefix `users`):
	- `/users/all-bookings`, `/users/all-orders`, `/users/review`
- Admin routes (guarded by admin auth): dashboard, `allFoods`, `allOrders`, `allBooking`, admin management

Check `routes/web.php` for exact route definitions and controller method mappings.

## Notes & Recommendations

- Security & validation: Controller methods perform basic validation. For production, ensure stricter validation, CSRF protection and sanitized inputs where needed.
- Payments: PayPal endpoints are view-based scaffolding — integrate the real PayPal SDK or Laravel Cashier for production payments.
- File storage: Images are stored in `public/img/`. Consider using Laravel's Storage facade and a cloud provider for production.
- Tests: Add feature/unit tests to cover booking, checkout and admin flows.

## How to contribute

1. Fork the repo and create a feature branch.
2. Add tests for your change.
3. Open a pull request with a clear description.

## License

MIT

## Contact

Project owner: `youssefbelfeki` (repository owner)

