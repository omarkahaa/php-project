# Flight Training Logbook

This project is a small native PHP web application for keeping personal flight training records.
The idea is to have one connected user who can save flights, update them later, and delete records when needed.

## Features

- User registration
- Login and logout
- Session management with `$_SESSION`
- Redirection with `header("Location: ...")`
- Add, display, edit and delete flight records
- Flight summary with total flights, total time and total landings
- OOP with separate PHP classes
- PDO database connection
- Prepared statements
- MySQL database
- Simple HTML/CSS interface

## Files

- `ManageData.php`: database connection and shared query methods
- `User.php`: account creation, login, session check and logout
- `FlightRecord.php`: methods for adding, displaying, updating and deleting flights
- `login.php`, `register.php`, `dashboard.php`, `new_flight.php`, `edit_flight.php`: application pages
- `login_action.php`, `register_action.php`, `save_flight.php`, `update_flight.php`, `delete_flight_action.php`: form processing files
- `database.sql`: database and sample data
- `style.css`: simple page styling

## How to run with XAMPP

1. Put the folder inside:

```text
/Applications/XAMPP/xamppfiles/htdocs/
```

2. Start Apache and MySQL.

3. Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

4. Import `database.sql`.

5. Open the project:

```text
http://localhost/flight_logbook_omar2026/login.php
```

## Test account

```text
Email: student@epita.fr
Password: password
```
