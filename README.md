# BROKERDESK

Real-estate brokerage management system built with **PHP** and **MySQL**. Browse properties, register as a user or agent, submit property requests, and manage listings from admin and agent panels.

## Features

- Public property listings (sale / rent) with city & state filters
- User registration and login
- Agent panel — add, edit, and manage own properties and customer requests
- Admin panel — users, agents, properties, locations, contacts, feedback, about content
- Contact form, feedback, and simple loan / EMI calculator

## Requirements

- PHP >= 7.3 (mysqli, GD)
- MySQL >= 5.7 (or MariaDB)
- Apache (XAMPP / WAMP recommended for local use)

## Installation (XAMPP)

1. Copy this project into your web root, e.g. `htdocs/BROKERDESKMAIN`
2. Start **Apache** and **MySQL**
3. Create / import the database:
   - Open phpMyAdmin
   - Import `Database/developers.sql`
   - Database name: **`developers`**
4. If property requests fail after import, create the missing `request` table:

```sql
CREATE TABLE `request` (
  `rid` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `requirements` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

5. Update DB credentials in:
   - `config.php`
   - `admin/config.php`

```php
$con = mysqli_connect("localhost", "root", "", "developers");
```

6. Open in the browser:
   - Site: `http://localhost/BROKERDESKMAIN/`
   - Admin: `http://localhost/BROKERDESKMAIN/admin/`
   - Agent: `http://localhost/BROKERDESKMAIN/agent/login.php`

## Sample login (from seed data)

| Role  | Username / Email     | Password |
|-------|----------------------|----------|
| Admin | `admin`              | `admin`  |
| Agent | `aryan@gmail.com`    | `aryan`  |
| User  | `demo@gmail.com`     | `demo`   |

> Passwords in the demo database are stored in plaintext for local learning only. Do not use this as-is in production.

## Project structure

```
BROKERDESKMAIN/
├── admin/          # Admin panel
├── agent/          # Agent panel
├── include/        # Shared header / footer
├── Database/       # SQL dump
├── css/, js/, images/
├── config.php      # DB connection
└── index.php       # Public home
```

## Deploy on Render (GitHub → live site)

Render has no native PHP runtime. This repo includes a `Dockerfile`.

1. Create a **MySQL** database somewhere (Render does not provide MySQL). Free options: [Aiven](https://aiven.io/), [Railway](https://railway.app/), or another MySQL host.
2. Import `Database/developers.sql`, then create the `request` table (see Installation above).
3. On Render: New Web Service → connect `BROKERDESK` → Language **Docker** → prefer **Free** plan if shown.
4. Add environment variables:

| Key | Value |
|-----|--------|
| `DB_HOST` | your MySQL host |
| `DB_USER` | your MySQL user |
| `DB_PASS` | your MySQL password |
| `DB_NAME` | your MySQL database name |

5. Deploy. Open the Render URL when the build finishes.

## License

Educational / demo project. Use and modify freely for learning.
