# Web Technologies and Secure Websites - Practical Assignment #3

This project demonstrates PHP server-side scripting, MySQL integration, OOP, PDO prepared statements, authentication, sessions, cookies, service CRUD, dynamic service search, and contact form validation.

## Setup

1. Install XAMPP.
2. Start Apache and MySQL.
3. Open phpMyAdmin and create a database named `webdev_project`.
4. Copy this folder to your XAMPP `htdocs` directory.
5. In a browser, run:
   `http://localhost/webdev_pw3_project/includes/setup.php`
6. Open:
   `http://localhost/webdev_pw3_project/index.php`

## Main pages

- `index.php` - Homepage with welcome/cookie message.
- `register.php` - User registration with PHP validation and password hashing.
- `login.php` - Login with PHP sessions and cookies.
- `logout.php` - Ends the session.
- `services.php` - Dynamic services with Bootstrap cards and SQL LIKE search.
- `dashboard.php` - Admin service list with edit/delete links.
- `add_service.php` - Adds a service.
- `edit_service.php` - Updates a service.
- `delete_service.php` - Deletes a service.
- `contact.php` - Contact form with JavaScript and PHP validation.

## Database tables

- `services(id, title, description, image)`
- `users(id, username, email, password)`
- `messages(id, name, email, message, created_at)`

## Security notes

- All database operations use PDO prepared statements.
- Passwords are stored using `password_hash()`.
- User output is escaped with `htmlspecialchars()`.
- Dashboard CRUD pages require an active session.
